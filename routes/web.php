<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('CheckAdminAuth')->group(function () {
    Route::get('/admin/logs', [AdminController::class, 'index'])->name('admin.logs');
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::view('family-list', '/Auth/Admin-login/family-list');

    Route::get('family-list', [AdminController::class, 'familyList']);
    Route::get('member-list', [AdminController::class, 'memberList']);
    Route::get('state-list', [AdminController::class, 'stateList']);
    Route::get('city-list', [AdminController::class, 'cityList']);

    // search head

    // routes/web.php
    Route::get('redirect-search/{type}', [AdminController::class, 'redirectToEncryptedSearch'])->name('redirect-search');
    Route::get('search-head/{search?}', [AdminController::class, 'searchHead'])->name('search-head');

    Route::get('redirect-search-member/{type}', [AdminController::class, 'redirectToEncryptedSearch'])->name('redirect-search-member');
    Route::get('search-member/{search?}', [AdminController::class, 'searchMember'])->name('search-member');

    Route::get('redirect-search-state/{type}', [AdminController::class, 'redirectToEncryptedSearch'])->name('redirect-search-state');
    Route::get('search-state/{search?}', [AdminController::class, 'searchState'])->name('search-state');

    Route::get('redirect-search-city/{type}', [AdminController::class, 'redirectToEncryptedSearch'])->name('redirect-search-city');
    Route::get('search-city/{search?}', [AdminController::class, 'searchCity'])->name('search-city');

    // Edit family head

    Route::get('edit-family-head/{encrypted_id}', [AdminController::class, 'editFamilyHead'])->name('edit-family-head');
    Route::put('edit-family-head-data/{encrypted_id}', [AdminController::class, 'editFamilyHeadData'])
        ->name('edit-family-head-data');

    // Edit family member
    Route::view('edit-family-member', '/Auth/Admin-login/edit-family-member');
    Route::get('edit-family-member/{encrypted_id}/{id}', [AdminController::class, 'editFamilyMember']);
    Route::put('edit-family-member-data/{encrypted_id}/{id}', [AdminController::class, 'editFamilyMemberData']);

    // Edit member from member list
    Route::get('edit-family-member-from-list/{encrypted_id}', [AdminController::class, 'editFamilyMemberFromList']);
    Route::put('edit-family-member-data-from-list/{encrypted_id}', [AdminController::class, 'editFamilyMemberDataFromList']);

    Route::view('edit-city-from-list', '/Auth/Admin-login/edit-city-from-list');
    Route::get('/edit-city-from-list/{encrypted_city_id}', [AdminController::class, 'editCityFromList'])->name('edit-city-from-list');
    Route::put('edit-city-data-from-list/{encrypted_city_id}', [AdminController::class, 'editCityDataFromList']);

    Route::post('/check-mobile-uniqueness', [AdminController::class, 'checkMobileUniqueness'])->name('check.mobile.uniqueness');
    // View family Details
    Route::view('view-family-details', '/Auth/Admin-login/view-family-details');
    Route::get('view-family-details/{encrypted_id}', [AdminController::class, 'viewFamilyDetails'])->name('view-family-details');

    // delete family details
    Route::delete('delete-family-details/{id}', [AdminController::class, 'deleteFamilyDetails'])->name('delete-family-details');

    // delete family member
    Route::delete('delete-family-member/{id}', [AdminController::class, 'deleteFamilyMember'])->name('delete-family-member');

    // family details data download
    Route::get('/view-family-details-pdf', [AdminController::class, 'exportPDF'])->name('view-family-details-pdf');
    Route::get('/view-family-details-excel', [AdminController::class, 'exportExcel'])->name('view-family-details-excel');

    // Search family details data download
    Route::get('/search-view-family-details-pdf', [AdminController::class, 'exportPDFSearchHead'])->name('search-view-family-details-pdf');
    Route::get('/search-view-family-details-excel', [AdminController::class, 'exportExcelSearchHead'])->name('search-view-family-details-excel');

    // View state Details

    Route::get('view-state-details/{encrypted_state_id}', [AdminController::class, 'viewStateDetails'])->name('view-state-details');

    // delete state details
    Route::delete('delete-state-details/{state_id}', [AdminController::class, 'deleteStateDetails'])->name('delete-state-details');
    // delete city
    Route::delete('delete-city/{city_id}', [AdminController::class, 'deleteCity'])->name('delete-city');

    // Edit state

    Route::get('edit-state/{encrypted_state_id}', [AdminController::class, 'editState'])->name('edit-state');
    Route::put('edit-state-data/{encrypted_state_id}', [AdminController::class, 'editStateData']);

    // Edit City

    Route::get('edit-city/{encrypted_state_id}/{city_id}', [AdminController::class, 'editCity']);
    Route::put('edit-city-data/{encrypted_state_id}/{city_id}', [AdminController::class, 'editCityData']);

    // edit city from list
    Route::view('edit-city-from-list', '/Auth/Admin-login/edit-city-from-list');
    Route::get('/edit-city-from-list/{encrypted_city_id}', [AdminController::class, 'editCityFromList'])->name('edit-city-from-list');
    Route::put('edit-city-data-from-list/{encrypted_city_id}', [AdminController::class, 'editCityDataFromList']);

    // new state add
    Route::view('add-state', 'add-state');
    Route::post('add-state', [AdminController::class, 'addState']);

    // //new city addition
    // Route::get('/add-city', [AdminController::class, 'showAddCityForm'])->name('add-city-form');
    // Route::view('add-city', 'add-city');
    // Route::post('add-city', [AdminController::class, 'addCity'])->name('add-city');
    // Route::get('add-city', [AdminController::class, 'addStates_state']);
    // Route::post('/check-city', [AdminController::class, 'checkCity'])->name('check-city');
    // Route::get('/add-city/{state_id}', [AdminController::class, 'showAddCityForm'])->name('add-city-form');

    Route::get('/add-city', [AdminController::class, 'showAddCityForm'])->name('add-city-form');

    Route::post('/add-city', [AdminController::class, 'addCity'])->name('add-city');

    Route::post('/check-city', [AdminController::class, 'checkCity'])->name('check-city');

    // User Registration
    Route::view('user-registration-admin', '/Auth/Admin-login/user-registration-admin');
    Route::post('user-registration-admin', [AdminController::class, 'userRegistrationAdmin']);
    Route::get('user-registration-admin', [AdminController::class, 'addStates']);

    Route::post('get-cities', [AdminController::class, 'getCities'])->name('get.cities');

    // Show Add Family Member Form
    Route::get('add-family-member-admin/{encrypted_id}', [AdminController::class, 'addFamilyMemberFormAdmin'])
        ->name('add-member-form-admin');

    Route::post('add-family-member-admin', [AdminController::class, 'addFamilyMemberAdmin'])
        ->name('add-member-submit-admin');
});

Route::view('admin-login', '/Auth/Admin-login/admin-login');
// Request reset link

Route::post('admin-login', [AdminController::class, 'login']);
Route::get('admin-logout', [AdminController::class, 'logout']);

Route::get('/admin-forget-password', function () {
    return view('Auth.Admin-login.admin-forget-password');
});

Route::post('/admin-forget-password', [AdminController::class, 'AdminForgetPassword'])->name('admin-forget-password');

Route::get('/admin-reset-password', [AdminController::class, 'AdminResetForgetPassword'])->name('admin-reset-password');

Route::post('/admin-set-forget-password', [AdminController::class, 'AdminSetForgetPassword'])->name('admin-set-password');

// User Registration
Route::get('user-registration', [UserController::class, 'addStates']);
Route::post('user-registration', [UserController::class, 'userRegistration']);
Route::post('get-cities', [UserController::class, 'getCities'])->name('get.cities');
Route::post('/check-mobile-uniqueness', [UserController::class, 'checkMobileUniqueness'])->name('check.mobile.uniqueness');

use App\Http\Controllers\PowerBIController;

Route::get('/powerbi', [PowerBIController::class, 'index'])->name('powerbi.index');
