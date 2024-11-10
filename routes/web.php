<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login',[LoginController::class,'index']) -> name('login');
// Route::get('/dashboard',[DashboardController::class,'index']);

Route::post('/login',[LoginController::class,'authenticate']);

Route::resource('/dashboard',DashboardController::class);
