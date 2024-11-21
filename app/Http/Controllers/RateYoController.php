<?php

namespace App\Http\Controllers;
use App\Models\RateYo;
use Illuminate\Http\Request;
use App\Http\Requests\RateYoRequest;

class RateYoController extends Controller
{
    //
    public function store(RateYoRequest $request){
        $rate_yo = RateYo::create([
            'course_id' => $request->course_id,
            'status' => RateYo::notApprovedYet,
            'comment' => $request->comment,
            'rate' => $request->rate,
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'data' => $rate_yo,
            'success' => true,
            'message' => 'Đánh giá kháo học thành công'
        ]);
    }

    public function update_web($id,$status){
        $check = $this->update($id,$status);
        if($check->original['success']){
            toastr()->success($check->original['message']);
            return redirect()->back();
        }else{
            toastr()->error($check->original['message']);
            return redirect()->back();
        }
    }
    public function update($id, $status){
        $rate_yo = RateYo::find($id);
        if($rate_yo){
            $rate_yo->status = $status;
            $rate_yo->save();
            return response()->json([
                'data' => $rate_yo,
               'success' => true,
               'message' => 'Cập nhật khóa học thành công'
            ]);
        }
        return response()->json([
           'success' => false,
           'message' => 'RateYo not found'
        ]);

    }

    public function index(){
        $rateYos = RateYo::with('Course')->get();
       
        $array = [];
        foreach ($rateYos->groupBy('course_id') as $productId => $group) {
            // Khởi tạo các biến đếm status
            $statusCount = [
                'status_1' => 0,
                'status_2' => 0,
                'status_3' => 0
            ];
        
            // Duyệt qua từng rateYo của cùng product_id và đếm status
            foreach ($group as $rate) {
                switch ($rate->status) {
                    case 1:
                        $statusCount['status_1']++;
                        break;
                    case 2:
                        $statusCount['status_2']++;
                        break;
                    case 3:
                        $statusCount['status_3']++;
                        break;
                }
            }
        
            // Lưu kết quả vào mảng với product_id và status count
            $array[] = [
                'course_id' => $productId,
                'product_name' => optional($group->first()->product)->name, // Lấy tên product nếu tồn tại
               
                'status_count' => $statusCount
            ];
        }
        return view('rate_yo.index',compact('array'));
    }

    public function editWeb($id){
        $rateYos = RateYo::with('Course','User')->where('course_id',$id)->get();
        // dd($rateYos);
        return view('rate_yo.edit',compact('rateYos'));

    }
}
