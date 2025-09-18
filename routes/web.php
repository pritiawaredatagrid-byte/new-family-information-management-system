<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\UserRegistration;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('CheckAdminAuth')->group(function () {
    Route::get('/admin/logs', [AdminController::class, 'index'])->name('admin.logs');
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::view('family-list', '/Auth/Admin-login/family-list');

    Route::get('family-list', [AdminController::class, 'familyList']);

    Route::get('state-list', [AdminController::class, 'stateList']);
    Route::get('city-list', [AdminController::class, 'cityList']);

    Route::get('search-head', [AdminController::class, 'searchHead'])->name('search-head');

    Route::get('search-state', [AdminController::class, 'searchState'])->name('search-state');

    Route::get('admin-logout', [AdminController::class, 'logout']);


    //Edit family head
    Route::view('edit-family-head', '/Auth/Admin-login/edit-family-head');
    Route::get('edit-family-head/{id}', [AdminController::class, 'editFamilyHead']);
    Route::put('edit-family-head-data/{id}', [AdminController::class, 'editFamilyHeadData']);

    //Edit family member
    Route::view('edit-family-member', '/Auth/Admin-login/edit-family-member');
    Route::get('edit-family-member/{head_id}/{id}', [AdminController::class, 'editFamilyMember']);
    Route::put('edit-family-member-data/{head_id}/{id}', [AdminController::class, 'editFamilyMemberData']);

    Route::post('/check-mobile-number', function (Request $request) {
        $mobileNumber = $request->input('mobile_number');
        $currentId = $request->input('current_id');

        $isUnique = !UserRegistration::where('mobile_number', $mobileNumber)
            ->where('id', '!=', $currentId)
            ->exists();

        return response()->json($isUnique);
    });

    //View family Details
    Route::view('view-family-details', '/Auth/Admin-login/view-family-details');
    Route::get('view-family-details/{id}', [AdminController::class, 'viewFamilyDetails'])->name('view-family-details');

    // delete family details
    Route::delete('delete-family-details/{id}', [AdminController::class, 'deleteFamilyDetails'])->name('delete-family-details');

    // delete family member
    Route::delete('delete-family-member/{id}', [AdminController::class, 'deleteFamilyMember'])->name('delete-family-member');

    Route::get('view-family-details-pdf/{id}', [AdminController::class, 'viewFamilyDetailsPdf'])->name('view-family-details-pdf');
    Route::get('export-pdf/{id}', [AdminController::class, 'exportPDF'])->name('export-pdf');
    Route::get('export-excel/{id}', [AdminController::class, 'exportExcel'])->name('export-excel');
    Route::get('view-family-details-excel/{id}', [AdminController::class, 'viewFamilyDetailsExcel'])->name('view-family-details-excel');

    //View state Details
    Route::view('view-state-details', '/Auth/Admin-login/view-state-details');
    Route::get('view-state-details/{state_id}', [AdminController::class, 'viewStateDetails'])->name('view-state-details');

    // delete state details
    Route::delete('delete-state-details/{state_id}', [AdminController::class, 'deleteStateDetails'])->name('delete-state-details');
    // delete city
    Route::delete('delete-city/{city_id}', [AdminController::class, 'deleteCity'])->name('delete-city');

    //Edit state
    Route::view('edit-state', '/Auth/Admin-login/edit-state');
    Route::get('edit-state/{state_id}', [AdminController::class, 'editState']);
    Route::put('edit-state-data/{state_id}', [AdminController::class, 'editStateData']);

    // Edit City
    Route::view('edit-city', '/Auth/Admin-login/edit-city');
    Route::get('edit-city/{state_id}/{city_id}', [AdminController::class, 'editCity']);
    Route::put('edit-city-data/{state_id}/{city_id}', [AdminController::class, 'editCityData']);

    //new state add
    Route::view('add-state', 'add-state');
    Route::post('add-state', [AdminController::class, 'addState']);

    // //new city addition
    Route::view('add-city', 'add-city');
    Route::post('add-city', [AdminController::class, 'addCity'])->name('add-city');
    Route::get('add-city', [AdminController::class, 'addStates_state']);

    //User Registration
    Route::view('user-registration-admin', '/Auth/Admin-login/user-registration-admin');
    Route::post('user-registration-admin', [AdminController::class, 'userRegistrationAdmin']);
    Route::get('user-registration-admin', [AdminController::class, 'addStates']);

    Route::post('get-cities', [AdminController::class, 'getCities'])->name('get.cities');

    Route::view('add-family-member-admin', '/Auth/Admin-login/add-family-member-admin');
    Route::get('add-family-member-admin/{head_id}', [AdminController::class, 'addFamilyMemberFormAdmin'])->name('add-member-form-admin');
    Route::post('add-family-member-admin', [AdminController::class, 'addFamilyMemberAdmin'])->name('add-member-submit-admin');
});



Route::view('admin-login', '/Auth/Admin-login/admin-login');
Route::view('admin-forget-password', '/Auth/Admin-login/admin-forget-password');
Route::post('admin-forget-password', [AdminController::class, 'AdminForgetPassword']);
Route::get('admin-forget-password/{email}', [AdminController::class, 'AdminResetForgetPassword']);
Route::post('admin-set-forget-password', [AdminController::class, 'AdminSetForgetPassword']);
Route::post('admin-login', [AdminController::class, 'login']);

// Route::get('member-list', [AdminController::class, 'memberList']);

//User Registration
Route::view('user-registration', 'user-registration');
Route::post('user-registration', [UserController::class, 'userRegistration']);
Route::get('user-registration', [UserController::class, 'addStates']);
Route::post('get-cities', [UserController::class, 'getCities'])->name('get.cities');

Route::view('add-family-member', 'add-family-member');
Route::get('add-family-member/{head_id}', [UserController::class, 'addFamilyMemberForm'])->name('add-member-form');
Route::post('add-family-member', [UserController::class, 'addFamilyMember'])->name('add-member-submit');
// Route::view('head-list', 'head-list');

use App\Http\Controllers\PowerBIController;

Route::get('/powerbi', [PowerBIController::class, 'index'])->name('powerbi.index');