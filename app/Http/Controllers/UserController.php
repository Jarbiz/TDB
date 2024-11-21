<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $page = $request->page ?? 1;
        $pageSize = $request->per_page ?? 100;
        $query  = User::orderByDesc('created_at')->where('deleted_at', User::UNDELETE);
        if($request->status){
            $user = $query->where('status', $request->status);
        }
        if($pageSize){
            $user = $query->paginate($pageSize, ['*'], 'page', $page);
        }else{
            $user = $query->get();
        }
        return response()->json([
            'data' => $user,
            'success' => true,
            'message' => 'User list retrieved successfully'
        ]);
    }


    public function index_web(){
        $query  = User::orderByDesc('created_at')->where('deleted_at', User::UNDELETE)->get();
    
        return view('user.index',compact('query'));
    }
    public function edit($id){
        $user = User::find($id);
        if($user){
            return response()->json([
                'data' => $user,
               'success' => true,
               'message' => 'User retrieved successfully'
            ]);
        }else{
            return response()->json([
               'success' => false,
               'message' => 'User not found'
            ], 404);
        }
    }

    public function update_web(StoreUserRequest $request){
        $categoryController = new UserController();
        $storeCategoryRequest = StoreUserRequest::createFromBase($request);
        $a = $categoryController->update($storeCategoryRequest,$request->id);
        if($a->original['success']){
            toastr()->success($a->original['message']);
            return redirect()->back();
        }else{
            toastr()->error($a->original['message']);
            return redirect()->back();
        }

    }

    public function update(Request $request, $id){
        dd($request->all());
        $user = User::find($id);
        if($user){
            $user->update([
                'name' => $request->name,
                'first_name'=>$request->first_name,
                'phone'=>$request->phone,
                'address'=>$request->address,
               
                'gender' => $request->gender,
                'status' => $request->status,
                'role_id' => $request->role_id
            ]);
            if($request->password){
                $user->update([
                    'password' =>  bcrypt($request->password),
                ]);
            }
            if ($request->hasFile('images') && $request->file('images')->isValid()) {
                $user->update([
                    'images' => $this->uploadFile($request->file('images'))
                ]);
            }
            return response()->json([
                'data' => $user,
               'success' => true,
               'message' => 'Cập nhật thành công'
            ]);
        } else{
            return response()->json([
               'success' => false,
               'message' => 'User not found'
            ], 404);
        }
    }

    public function destroy_web($id){
        $delete = $this->destroy($id);
        if($delete->original['success']){
            toastr()->success($delete->original['message']);
            return redirect()->route('users.index');
        }else{
            toastr()->error($delete->original['message']);
            return redirect()->route('users.index');
        }
    }
    public function destroy($id){
        $user = User::find($id);
        if($user){
            $user->update([
                'deleted_at' => User::DELETE
            ]);
            return response()->json([
               'success' => true,
               'message' => 'Xóa thành công'
            ]);

        } else{
            return response()->json([
               'success' => false,
               'message' => 'User not found'
            ], 404);
        }
    }


    public function store_web(StoreUserRequest $request) {
    
        $categoryController = new UserController();
        $storeCategoryRequest = StoreUserRequest::createFromBase($request);
        $a = $categoryController->store($storeCategoryRequest);
        if($a->original['success']){
            toastr()->success($a->original['message']);
            return redirect()->route('users.index');
        }else{
            toastr()->error($a->original['message']);
            return redirect()->route('users.index');
        }
    }

    public function store(StoreUserRequest $request){
        $images = null;
        if ($request->hasFile('images') && $request->file('images')->isValid()) {
          $images =  $this->uploadFile($request->file('images'));
           
        }
        $check = User::where('email',$request->email)->first();
        if($check)
        { 
            return response()->json([
               'success' => false,
               'message' => 'Email đã tồn tại'
            ], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'first_name'=>$request->first_name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
            'role_id' => $request->role ?? 2,
            'gender' => $request->gender,
            'status' => User::ACTIVE,
            'images' => $images,
            'deleted_at' => User::UNDELETE
        ]);
        return response()->json([
            'data' => $user,
           'success' => true,
           'message' => 'User created successfully'
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

    public function checkChangePassword(Request $request){
        $id = $request->id;
        $user = User::find($id);
        if($user && Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            Auth::logout();
            return response()->json([
               'success' => true,
               'message' => 'Password matched'
            ]);
        }else{
            return response()->json([
               'success' => false,
               'message' => 'Password not matched'
            ]);
        }
    }


    public function login(Request $request){
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($login)) {
            $user = Auth::user();
            return response()->json([
               'success' => true,
                'user' => $user,
               'message' => 'Logged in successfully'
            ]);
        }else{
            return response()->json([
               'success' => false,
               'message' => 'Invalid credentials'
            ], 401);
        }
        
    }


    public function logout() {
        Auth::logout();
        return response()->json([
           'success' => true,
           'message' => 'Logged out successfully'
        ]);
    }

    public function logout_web() {
        Auth::logout();
        return redirect()->route('doashboard');
    }

    public function postLogin(Request $request){
        $validated = $request->only('email', 'password');
        $login_status = false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $login_status = true;
        }
        if($login_status){
            if(auth()->user()->role_id != 1){
                $request->session()->flush();
                toastr()->error('Không có quyền truy cập...!');
                return redirect()->back();
            }
            if(auth()->user()->deleted_at == 2){
                $request->session()->flush();
                toastr()->error('Tài khoản đã bị xóa...!');
                return redirect()->back();
            }
            if(auth()->user()->status == 2){
                $request->session()->flush();
                toastr()->error('Tài khoản đã bị khóa...!');
                return redirect()->back();
            }
            toastr()->success('Đăng nhập thành công...!');
            return redirect()->route('doashboard');
        }
        else{
            toastr()->error('Đăng nhập thất bại.');
            return redirect()->back();
        }
    }
}
