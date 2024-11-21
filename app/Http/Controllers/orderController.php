<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderTamp;
class orderController extends Controller
{
    public function storeOrderTamp(Request $request){
        $id = $request->course_id;
        if(!$request->course_id || !$request->user_id){
            return response()->json([
               'success' => false,
               'message' => 'ID người dùng và ID khóa học không bỏ trống'
            ], 400);
        }
        
        $order_tamp = OrderTamp::where('course_id', $id)->where('user_id',$request->user_id)->first();
        if($order_tamp){
            return response()->json([
               'success' => false,
               'message' => 'Khóa học đã có trong giỏ hàng'
            ], 400);
        }
        $order_detail = OrderDetail::where('course_id', $id)->where('user_id',$request->user_id)->first();
        if($order_detail){
            $order_check = Order::where('id',$order_detail->orders_id)->first();
            if($order_check->status == 1 || $order_check->status == 2 ){
                return response()->json([
                    'success' => false,
                    'message' => 'Khóa học đang chờ thanh toán hoặc đã thanh toán'
                 ], 400);
            }
        }
        $order = Course::find($id)->first();
        $order = OrderTamp::create([
            'course_id' => $id,
            'price' => $order->price,
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'data' => $order,
            'success' => true,
            'message' => 'User list retrieved successfully'
        ]);

    }

    public function deleteCourseOrder(Request $request){
        $id = $request->course_id;
        if(!$request->course_id ||!$request->user_id){
            return response()->json([
               'success' => false,
               'message' => 'ID người dùng và ID khóa học không bỏ trống'
            ], 400);
        }
        $order_tamp = OrderTamp::where('course_id', $id)->where('user_id',$request->user_id)->first();
        if(!$order_tamp){
            return response()->json([
               'success' => false,
               'message' => 'Không tìm thấy khóa học trong giỏ hàng hàng'
            ], 404);
        }
        $order_tamp->delete();
        return response()->json([
            'success' => true,
            'message' => 'Xóa giỏ  hàng thành công'
         ]);
    }
    
    public function destroyAll(Request $request){
        OrderTamp::where('user_id', $request->user_id)->delete();
        return response()->json([
           'success' => true,
           'message' => 'Xóa giỏ  hàng thành công'
        ]);
    }

    public function storeOrder(Request $request){
        $user_id = $request->user_id;
        $order_tamp = OrderTamp::where('user_id', $user_id)->get();
        $order_store = Order::create([
            'status' => Order::NOT_YET_PAIN,
            'user_id' => $user_id,
        ]);
        $total = 0;
        foreach($order_tamp as $tamp){
            OrderDetail::create([
                'orders_id' => $order_store->id,
                'course_id' => $tamp->course_id,
                'user_id' => $user_id,
                'price' => $tamp->price,
            ]);
            $total += $tamp->price;
        }
        $order_store->total = $total;
        $order_store->save();
        $order_tamp = OrderTamp::where('user_id', $user_id)->delete();
        return response()->json([
            'data' => $order_store,
            'success' => true,
            'message' => 'User list retrieved successfully'
        ]);
    }


    public function accept_orderWeb(Request $request){
        $edit = $this->acceptOrder($request);
        if($edit->original['success']){
            $data = $edit->original['data'];
            toastr()->success($edit->original['message']);
            return redirect()->route('order.index');
        }else{
            toastr()->error($edit->original['message']);
            return redirect()->route('order.index');
        }
    }

    public function acceptOrder(Request $request){
        $id = $request->id;
        if(!$id){
            return response()->json([
               'success' => false,
               'message' => 'ID đơn hàng không bỏ trống'
            ], 400);
        }
        $order = Order::find($id);
        if(!$order){
            return response()->json([
               'success' => false,
               'message' => 'Không tìm thấy đơn hàng'
            ], 404);
        }
        $order->status = $request->status;
        $order->save();
        return response()->json([
            'data' => $order,
            'success' => true,
            'message' => 'Thay đổi trạng thái thành công'
        ]);
    }



    public function index_web(Request $request){
        $order = Order::orderByDesc('created_at')->with('OrderDetails','User')->get();
        return view('orders.index',compact('order'));
    }
    public function index(Request $request){
        $page = $request->page ?? 1;
        $pageSize = $request->per_page ?? 100;
        $query  = Order::orderByDesc('created_at')->with('OrderDetails','User');
        if($request->status){
            $orders = $query->where('status', $request->status);
        }
        if($request->user_id){
            $orders = $query->where('user_id', $request->user_id);
        }
        if ($pageSize) {
            $orders = $query->paginate($pageSize, ['*'], 'page', $page);
        } else {
            $orders = $query->get();
        }
        return response()->json([
            'data' => $orders,
            'success' => true,
            'message' => 'Lấy hóa đơn thành công'
        ]);
    }


    public function edit_web($id){
        $edit = $this->edit($id);
        if($edit->original['success']){
            $data = $edit->original['data'];
 
            toastr()->success($edit->original['message']);
            return view('orders.edit',compact('data'));
        }else{
            toastr()->error($edit->original['message']);
            return redirect()->route('order.index');
        }
    }

    public function edit($id)  {
        $query  = Order::with('OrderDetails.Course','User')->find($id);
        if(!$query){
            return response()->json([
               'success' => false,
               'message' => 'Không tìm thấy đơn hàng'
            ], 404);
        }else{
            return response()->json([
                'data' => $query,
               'success' => true,
               'message' => 'Lấy thông tin đơn hàng thành công'
            ]);
        }
    }

    public function courseOfMe($userId){
        $orders = Order::where('user_id', $userId)->where('status',Order::PAIN)->with('OrderDetails.Course','OrderDetails.Order')->get();
        $array = [];
        foreach($orders as $order){
            if(count($order->OrderDetails) > 0){
                foreach($order->OrderDetails as $orderD){
                    $array[] = $orderD;
                }
            }
        }  
        return response()->json([
            'data' => $array,
            'success' => true,
            'message' => 'Lấy hóa đơn của người dùng thành công'
        ]);
    }
}
