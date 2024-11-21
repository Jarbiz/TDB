<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Models\CategoryNew;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{

    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $pageSize = $request->per_page ?? 100;
        $query  = News::orderByDesc('created_at')->where('deleted_at', News::UNDELETE)->with('CategoryNew');
        if($request->status){
            $news = $query->where('status', $request->status);
        }
        if ($pageSize) {
            $news = $query->paginate($pageSize, ['*'], 'page', $page);
        } else {
            $news = $query->get();
        }
        return response()->json([
            'data' => $news,
            'success' => true,
            'message' => 'User list retrieved successfully'
        ]);
    }

    public function index_web(Request $request){
        $CategoryNew = CategoryNew::orderByDesc('created_at')->where('deleted_at', CategoryNew::UNDELETE)->get();
        $query  = News::orderByDesc('created_at')->where('deleted_at', News::UNDELETE)->with('CategoryNew')->get();
        // dd($query);
        return view('news.index', compact('query','CategoryNew'));

    }

    public function edit($id){
        $news = News::with('category_news')->find($id);
        if($news){ 
            return response()->json([
                'data' => $news,
                'success' => true,
               'message' => 'News retrieved successfully'
            ]);
        }else{
            return response()->json([
               'data' => '',
               'success' => false,
               'message' => 'News not found'
            ]);
        }
    }

    public function destroy_web($id){
        $delete = $this->destroy($id);
        if($delete->original['success']){
            toastr()->success($delete->original['message']);
            return redirect()->route('new.index');
        }else{
            toastr()->error($delete->original['message']);
            return redirect()->route('new.index');
        }
    }

    public function store_web(Request $request){
       
        $categoryController = new NewsController();
        $storeCategoryRequest = StoreNewsRequest::createFromBase($request);
        $a = $categoryController->store($storeCategoryRequest);

        if($a->original['success']){
            toastr()->success($a->original['message']);
            return redirect()->route('new.index');
        }else{
            toastr()->error($a->original['message']);
            return redirect()->route('new.index');
        }
    }
    
    public function destroy($id){
        $news = News::find($id);
        if($news){
            $news->update([
                'deleted_at' => News::DELETE,
            ]);
            return response()->json([
                'data' => '',
               'success' => true,
               'message' => 'Xóa thành công.'
            ]);
        }else{
            return response()->json([
               'data' => '',
               'success' => false,
               'message' => 'Không tìm thấy'
            ]);
        }
    }

    public function update_web(Request $request){
        $categoryController = new NewsController();
        $storeCategoryRequest = StoreNewsRequest::createFromBase($request);
        // dd($categoryController);
        $a = $categoryController->update($storeCategoryRequest,$request->id);
        if($a->original['success']){
            toastr()->success($a->original['message']);
            return redirect()->route('new.index');
        }else{
            toastr()->error($a->original['message']);
            return redirect()->route('new.index');
        }
        

    }

    public function update(StoreNewsRequest $request, $id){
        $news = News::find($id);
        if($news){

            $news->update([
                'title' => $request->title,
                'short_desc' => $request->short_desc,
                'cate_new_id' => $request->category_news_id,
                'deleted_at' => News::UNDELETE,
                'status' => $request->status,
                'description' => $request->description,
                'user_id' => $request->user_id,
            ]);
            if ($request->hasFile('images') && $request->file('images')->isValid()) {
                $news->update([
                    'images' => $this->uploadFile($request->file('images'))
                ]);
            }
            return response()->json([
                'data' => $news,
               'success' => true,
               'message' => 'Cập nhật thành công'
            ]);

        }else{
            return response()->json([
               'data' => '',
               'success' => false,
               'message' => 'News not found'
            ]);
    
        }
    }

    public function store(StoreNewsRequest $request) {
        $images = null;
        if ($request->hasFile('images') && $request->file('images')->isValid()) {
          $images =  $this->uploadFile($request->file('images'));
           
        }
        $news = News::create([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'cate_new_id' => $request->category_news_id,
            'deleted_at' => News::UNDELETE,
            'status' => News::ACTIVE,
            'description' => $request->description,
            'user_id' => $request->user_id ?? 1,
            'images' => $images,
        ]);
    
        return response()->json([
            'data' => $news,
            'success' => true,
            'message' => 'News created successfully'
        ]);
    }
    

    public function uploadFile($file)
    {
            $fileNameOriginal = $file->getClientOriginalName();
            $fileNameHas = Str::random(20) . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public', $fileNameHas);
            $result = [
                'file_name' => $fileNameOriginal,
                'file_path' => Storage::url($filePath)
            ];
            return asset($result['file_path']);
    }



    

    
}
