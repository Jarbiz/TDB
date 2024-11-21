<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});


    use App\Http\Controllers\UserController;
    use App\Http\Controllers\CategoryNewController;
    use App\Http\Controllers\NewsController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\RateYoController;
    use App\Http\Controllers\orderController;

    Route::group(['prefix' => 'category_new', 'as' => 'category_new.'], function () {
        Route::get('/index', [CategoryNewController::class, 'index'])->name('index');
        Route::post('/store', [CategoryNewController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryNewController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryNewController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryNewController::class, 'destroy'])->name('destroy');
        Route::post('/update', [CategoryNewController::class,'update'])->name('update');
    });

    Route::group(['prefix' => 'new', 'as' => 'new.'], function () {
        Route::get('/index', [NewsController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('edit');
        Route::delete('/delete/{id}', [NewsController::class, 'destroy'])->name('destroy');
        Route::post('/update/{id}', [NewsController::class, 'update'])->name('update');
        Route::post('/store', [NewsController::class,'store'])->name('store');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/index', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class,'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/update/{id}', [UserController::class,'update'])->name('update');
        Route::post('/check-change-password', [UserController::class, 'checkChangePassword'])->name('checkChangePassword');
        Route::post('login', [UserController::class, 'login'])->name('login');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('/index', [CourseController::class, 'index'])->name('index');
        Route::post('/store', [CourseController::class,'store'])->name('store');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CourseController::class, 'destroy'])->name('destroy');
        Route::post('/update-video/{id}', [CourseController::class, 'updateVideo'])->name('updateVideo');
        Route::post('/add-question', [CourseController::class, 'addQuestion'])->name('addQuestion');
        Route::get('/get-question-by-course-data/{couserId}', [CourseController::class, 'getQuestion'])->name('getQuestion');
        Route::post('/store-test', [CourseController::class, 'storeTest'])->name('storeTest');
        Route::post('/update-test', [CourseController::class, 'updateTest'])->name('updateTest');
        Route::post('/scoring-test', [CourseController::class, 'scoringTest'])->name('scoringTest');
        Route::get('/get-test/{id}', [CourseController::class, 'getTest'])->name('getTest');





    });


    Route::group(['prefix' => 'rateYo', 'as' => 'rateYo.'], function () {
        Route::post('/store', [RateYoController::class, 'store'])->name('store');
        Route::get('/update/{id}/{status}', [RateYoController::class, 'update'])->name('update');

    });


    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/index', [orderController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [orderController::class, 'edit'])->name('edit');
        Route::post('/store-order-tamp', [orderController::class, 'storeOrderTamp'])->name('storeOrderTamp');
        Route::post('/delete-course-order-tamp', [orderController::class, 'deleteCourseOrder'])->name('deleteCourseOrder');
        Route::post('/delete-all-course-order-tamp', [orderController::class, 'destroyAll'])->name('destroyAll');
        Route::post('/store-order', [orderController::class, 'storeOrder'])->name('storeOrder');
        Route::post('/accept-order', [orderController::class, 'acceptOrder'])->name('acceptOrder');
        Route::get('/course-of-me/{userId}', [orderController::class, 'courseOfMe'])->name('courseOfMe');
    });


