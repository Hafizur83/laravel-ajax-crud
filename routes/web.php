<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\CricketerController;
use App\Http\Controllers\TeacherController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('catagory', [CatagoryController::class,'index']);
Route::get('catagory/all', [CatagoryController::class,'allData']);
Route::post('/catagory/store', [CatagoryController::class,'store']);
Route::get('catagory/edit/{id}', [CatagoryController::class,'edit']);
Route::post('/catagory/update/{id}', [CatagoryController::class,'update']);
Route::get('catagory/destroy/{id}', [CatagoryController::class,'destroy']);


// Cricketer Route 
Route::get('cricketer', [CricketerController::class,'index']);
Route::get('cricketer/all', [CricketerController::class,'allData']);
Route::post('/cricketer/store', [CricketerController::class,'store']);
Route::get('cricketer/edit/{id}', [CricketerController::class,'edit']);
Route::post('/cricketer/update/{id}', [CricketerController::class,'update']);
Route::get('cricketer/destroy/{id}', [CricketerController::class,'destroy']);

// Teacher Route 

Route::get('teacher', [TeacherController::class,'index']);
Route::get('teacher/all', [TeacherController::class,'allData']);
Route::post('/teacher/store', [TeacherController::class,'store']);
Route::get('teacher/destroy/{id}', [TeacherController::class,'destroy']);