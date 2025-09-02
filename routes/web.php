<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('admin-login','/Auth/Admin-login/admin-login');
Route::view('admin-forget-password','/Auth/Admin-login/admin-forget-password');
Route::post('admin-forget-password',[AdminController::class,'AdminForgetPassword']);
Route::get('admin-forget-password/{email}',[AdminController::class,'AdminResetForgetPassword']);
Route::post('admin-set-forget-password',[AdminController::class,'AdminSetForgetPassword']);

Route::post('admin-login',[AdminController::class,'login']);
Route::get('dashboard', [AdminController::class, 'dashboard']);


Route::view('user-registration','user-registration');
Route::post('user-registration',[UserController::class,'userRegistration']);


Route::view('family-member-form','family-member-form');
Route::post('family-member-form',[UserController::class,'familyMember']);


