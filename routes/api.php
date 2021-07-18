<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TopicController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Public Route
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);
Route::resource('topic', TopicController::class)->only([
    'show','index'
]);
Route::get('/course',[CourseController::class,'index']);
Route::get('/course/{topic}',[CourseController::class,'showCourseTopic']);
Route::get('/course/{topic}/{acourse}',[CourseController::class,'showSpecificCourse']);

//Private Route
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::resource('topic', TopicController::class)->except([
        'index','show'
    ]);
    Route::get('/course/owner',[CourseController::class,'getOwnerCourse']);
    Route::put('/course/{topic}/{acourse}',[CourseController::class,'updateSpecificCourse']);
    Route::delete('/course/{topic}/{acourse}',[CourseController::class,'destroySpecificCourse']);
    Route::delete('/course/{topic}',[CourseController::class,'destroyCourseTopic']);
});
