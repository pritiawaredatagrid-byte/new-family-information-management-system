<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Session;


Route::get('/', function () {
    return view('welcome');
});

Route::view('admin-login','admin-login');
Route::view('user-registration','user-registration');
Route::view('family-member-form','family-member-form');

Route::post('admin-login',[AdminController::class,'login']);
Route::get('dashboard', [AdminController::class, 'dashboard']);