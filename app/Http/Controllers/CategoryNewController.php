<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryNew;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\StoreCategoryRequest;
use Symfony\Component\HttpFoundation\RequestStack;

class CategoryNewController extends Controller
{
    //

    public function index(Request $request)
    {

        $page = $request->page ?? 1;
        $pageSize = $request->per_page ?? 100;
        $query  = CategoryNew::orderByDesc('created_at')->where('deleted_at', CategoryNew::UNDELETE);

        if($request->status){
            $cate_new = $query->where('status', $request->status);
        }
        if ($pageSize) {
            $cate_new = $query->paginate($pageSize, ['*'], 'page', $page);
        } else {
            $cate_new = $query->get();
        }
        return response()->json([
            'data' => $cate_new,
            'success' => true,
            'message' => 'User list retrieved successfully'
        ]);
    }


    public function index_web(Request $request){
        $CategoryNew = CategoryNew::orderByDesc('created_at')->where('deleted_at', CategoryNew::UNDELETE)->get();
        return view('category_new.index',compact('CategoryNew'));
    }

    public function store_web(Request $request){
        $categoryController = new CategoryNewController();
        $storeCategoryRequest = StoreCategoryRequest::createFromBase($request);
        $a = $categoryController->store($storeCategoryRequest);
        if($a->original['success']){
            toastr()->success($a->original['message']);
            return redirect()->route('category_new.index');
        }else{
            toastr()->error($a->original['message']);
            return redirect()->route('category_new.index');
        }
    }
    public function store(StoreCategoryRequest  $request)
    {

            $store  = CategoryNew::create([
                'name' => $request->name,
                'description' => $request->description,
                'deleted_at' => CategoryNew::UNDELETE,
                'status' => CategoryNew::ACTIVE,
            ]);
            return response()->json([
                'data' => $store,
                'success' => true,
                'message' => 'Thêm danh mục tin  thành công'
            ]);
       
    }


    public function update_web(StoreCategoryRequest $request){
     
        $categoryController = new CategoryNewController();
        $a = $categoryController->update($request);
        if($a->original['success']){
            toastr()->success($a->original['message']);
            return redirect()->route('category_new.index');
        }else{
            toastr()->error($a->original['message']);
            return redirect()->route('category_new.index');
        }
        

    }
    public function update(StoreCategoryRequest $request){

        try {
            $category = CategoryNew::find($request->id);
            if ($category) {
                $category->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status
                ]);
                return response()->json([
                    'data' => $category,
                   'success' => true,
                   'message' => 'Cập nhật danh mục tin thành công'
                ]);
            } else {
                return response()->json([
                    'data' => null,
                   'success' => false,
                   'message' => 'Danh mục tin không tồn tại'
                ], 404);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'data' => null,
               'success' => false,
               'message' => $e->errors()
            ], 422);
        }
    }

    public function edit($id){
        try {
            $category = CategoryNew::find($id);
            if ($category) {
                return response()->json([
                    'data' => $category,
                   'success' => true,
                   'message' => 'Hiển thị danh mục tin thành công'
                ]);
            } else {
                return response()->json([
                    'data' => null,
                   'success' => false,
                   'message' => 'Danh mục tin không tồn tại'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
               'success' => false,
               'message' => 'Lỗi'
            ], 500);
        }
    }

    public function delete_web($id){
        $delete = $this->destroy($id);
        if($delete->original['success']){
            toastr()->success($delete->original['message']);
            return redirect()->route('category_new.index');
        }else{
            toastr()->error($delete->original['message']);
            return redirect()->route('category_new.index');
        }
    }
    public function destroy($id){

        try {
            $category = CategoryNew::find($id);
            if ($category) {
                $category->update([
                    'deleted_at' => CategoryNew::DELETE,
                ]);
                return response()->json([
                    'data' => null,
                   'success' => true,
                   'message' => 'Xóa danh mục tin thành công'
                ]);
            } else {
                return response()->json([
                    'data' => null,
                   'success' => false,
                   'message' => 'Danh mục tin không tồn tại'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
               'success' => false,
               'message' => 'Lỗi'
            ], 500);
        }
    }
}
