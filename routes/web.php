<?php

use App\Http\Controllers\CategoryNewController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\RateYoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    if(auth()->user()){
        return view('welcome');
    }else{
        return view('login');
    }
})->name('doashboard');


Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::post('/post-login', [UserController::class, 'postLogin'])->name('postLogin');
    Route::get('/logout-user', [UserController::class, 'logout_web'])->name('logout_web');
    Route::get('/index', [UserController::class, 'index_web'])->name('index');
    Route::get('/destroy/{id}', [UserController::class, 'destroy_web'])->name('destroy');
    Route::post('store', [UserController::class, 'store_web'])->name('store');
    Route::post('update', [UserController::class, 'update_web'])->name('update');


});


Route::group(['prefix' => 'category_new', 'as' => 'category_new.'], function () {
    Route::get('/index', [CategoryNewController::class, 'index_web'])->name('index');
    Route::post('/update', [CategoryNewController::class, 'update_web'])->name('update');
    Route::get('/delete-category/{id}', [CategoryNewController::class, 'delete_web'])->name('delete');
    Route::post('store', [CategoryNewController::class, 'store_web'])->name('store');
});

Route::group(['prefix' => 'new', 'as' => 'new.'], function () {
    Route::get('/index', [NewsController::class, 'index_web'])->name('index');
    Route::get('/destroy/{id}', [NewsController::class, 'destroy_web'])->name('destroy');
    Route::post('/store', [NewsController::class, 'store_web'])->name('store');
    Route::post('/update', [NewsController::class, 'update_web'])->name('update');
    
});


Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
    Route::get('/index', [CourseController::class, 'index_web'])->name('index');
    Route::post('/store', [CourseController::class, 'store_web'])->name('store');
    Route::get('/destroy/{id}', [CourseController::class, 'destroy_web'])->name('destroy');
    Route::post('/update', [CourseController::class, 'update_web'])->name('update');
    Route::get('/edit/{id}', [CourseController::class, 'edit_web'])->name('edit');
    Route::post('/store_video', [CourseController::class, 'storeVideo_web'])->name('store_video');
    Route::get('/get-question-by-course-data/{couserId}', [CourseController::class, 'getQuestionWeb'])->name('getQuestion');
    Route::post('/add-question', [CourseController::class, 'addQuestion_web'])->name('addQuestion');
    
});

Route::group(['prefix' => 'rateYo', 'as' => 'rateYo.'], function () {
    Route::get('/index', [RateYoController::class, 'index'])->name('index');
    Route::get('/edit/{id}', [RateYoController::class, 'editWeb'])->name('edit');
    Route::get('/update_web/{id}/{status}', [RateYoController::class, 'update_web'])->name('update_web');
});


Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/index', [orderController::class, 'index_web'])->name('index');
    Route::get('/edit/{id}', [orderController::class, 'edit_web'])->name('edit');
    Route::post('/accept-order', [orderController::class, 'accept_orderWeb'])->name('accept_orderWeb');
    Route::get('/destroy/{id}', [CourseController::class, 'destroy_web'])->name('destroy');




});