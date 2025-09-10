<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('admin-login', '/Auth/Admin-login/admin-login');
Route::view('admin-forget-password', '/Auth/Admin-login/admin-forget-password');
Route::post('admin-forget-password', [AdminController::class, 'AdminForgetPassword']);
Route::get('admin-forget-password/{email}', [AdminController::class, 'AdminResetForgetPassword']);
Route::post('admin-set-forget-password', [AdminController::class, 'AdminSetForgetPassword']);

Route::post('admin-login', [AdminController::class, 'login']);
Route::get('dashboard', [AdminController::class, 'dashboard']);

Route::view('family-list', '/Auth/Admin-login/family-list');
Route::get('family-list', [AdminController::class, 'familyList']);
Route::get('member-list', [AdminController::class, 'memberList']);
Route::get('state-list', [AdminController::class, 'stateList']);
Route::get('city-list', [AdminController::class, 'cityList']);

Route::get('search-head', [AdminController::class, 'searchHead'])->name('search-head');

Route::get('admin-logout', [AdminController::class, 'logout']);

Route::view('user-registration', 'user-registration');
Route::post('user-registration', [UserController::class, 'userRegistration']);
Route::get('user-registration', [UserController::class, 'addStates']);
Route::post('get-cities', [UserController::class, 'getCities'])->name('get.cities');

//Edit family head
Route::view('edit-family-head','/Auth/Admin-login/edit-family-head');
Route::get('edit-family-head/{id}', [AdminController::class, 'editFamilyHead']);
Route::put('edit-family-head-data/{id}', [AdminController::class, 'editFamilyHeadData']);

//Edit family member
Route::view('edit-family-member','/Auth/Admin-login/edit-family-member');
Route::get('edit-family-member/{head_id}/{id}', [AdminController::class, 'editFamilyMember']);
Route::put('edit-family-member-data/{head_id}/{id}', [AdminController::class, 'editFamilyMemberData']);


//View family Details
Route::view('view-family-details','/Auth/Admin-login/view-family-details');
Route::get('view-family-details/{id}', [AdminController::class, 'viewFamilyDetails'])->name('view-family-details');


//new state add
Route::view('add-state','add-state');
Route::post('add-state', [AdminController::class, 'addState']);

// //new city addition
Route::view('add-city','add-city');
Route::post('add-city',[AdminController::class, 'addCity'])->name('add-city');
Route::get('add-city', [AdminController::class, 'addStates']);
// Route::post('/store-city', [YourController::class, 'storeCity'])->name('store-city');


Route::view('add-family-member', 'add-family-member');
Route::post('add-family-member', [UserController::class, 'addFamilyMember']);
Route::view('head-list', 'head-list');



use App\Http\Controllers\PowerBIController;

Route::get('/powerbi', [PowerBIController::class, 'index'])->name('powerbi.index');