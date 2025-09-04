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
Route::get('admin-logout',[AdminController::class, 'logout']);

Route::view('user-registration','user-registration');
Route::post('user-registration',[UserController::class,'userRegistration']);
Route::get('user-registration',[UserController::class,'addStates']);
Route::post('get-cities',[UserController::class,'getCities'])->name('get.cities');;

Route::view('add-family-member','add-family-member');
Route::post('add-family-member',[UserController::class,'addFamilyMember']);

