<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login',[LoginController::class,'index']) -> name('login');
Route::get('/register',[RegisterController::class,'index']);
Route::get('/dashboard',[DashboardController::class,'index'])-> middleware('auth');

Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/register',[RegisterController::class,'store']);
Route::post('/logout',[LoginController::class,'logout']);

