<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\AnimalRegisterController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AffidavitController;
use App\Http\Controllers\AdvocateController;
use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PagesController;
use App\Models\CaseActivityLog;
use App\Http\Controllers\CaseActivityLogController;
use App\Http\Controllers\UserNotificationController;
Use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MinarController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\SiteSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Auth::routes([
    'login'    => true,
    'logout'   => true,
    'register' => false,
    'reset'    => true,   // for resetting passwords
    'confirm'  => false,  // for additional password confirmations
    'verify'   => false,  // for email verification
    ]);
// https://github.com/laravel/ui/blob/2.x/src/AuthRouteMethods.php
 //Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});


Route::post('/csLogin', [LoginController::class, 'csLogin']);


// Route::get('/', [DashboardController::class, 'logincheck']);
Route::get('/logincheck', [DashboardController::class, 'logincheck']);
Route::get('/registration', [RegistrationController::class, 'create'])->name('register');
Route::post('/registration/store', [RegistrationController::class, 'store'])->name('register.store');
route::get('/register/dropdownlist/getdependentdistrict/{id}', [RegistrationController::class , 'getDependentDistrict']);
route::get('/register/dropdownlist/getdependentupazila/{id}', [RegistrationController::class , 'getDependentUpazila']);
route::get('/register/dropdownlist/getdependentmouja/{id}', [RegistrationController::class , 'getDependentMouja']);
// Route::get('public_home', [FrontHomeController::class, 'public_home']);
Route::get('/', [FrontHomeController::class, 'public_home']);
Route::get('hearing-case-list', [FrontHomeController::class, 'dateWaysCase'])->name('dateWaysCase');

Route::get('case-hearing-details/{id}', [FrontHomeController::class, 'hearing_case_details'])->name('dateWaysCaseDetails');

Route::middleware('auth')->group(function () {
    // setting
    Route::get('site_setting', [SiteSettingController::class, 'edit'])->name('app.setting.index');
    Route::post('site_setting', [SiteSettingController::class, 'update'])->name('app.setting.update');

    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/databaseCaseCheck', [HomeController::class, 'databaseCaseCheck']);
    Route::get('/databaseDataUpdated', [HomeController::class, 'databaseDataUpdated']);

    /////****************** Dashboard *****************/////
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/hearing-case-details/{id}', [DashboardController::class, 'hearing_case_details'])->name('dashboard.hearing-case-details');
    Route::get('/dashboard/hearing-today', [DashboardController::class, 'hearing_date_today'])->name('dashboard.hearing-today');
    Route::get('/dashboard/hearing-tomorrow', [DashboardController::class, 'hearing_date_tomorrow'])->name('dashboard.hearing-tomorrow');
    Route::get('/dashboard/hearing-nextWeek', [DashboardController::class, 'hearing_date_nextWeek'])->name('dashboard.hearing-nextWeek');
    Route::get('/dashboard/hearing-nextMonth', [DashboardController::class, 'hearing_date_nextMonth'])->name('dashboard.hearing-nextMonth');


    /////******************* Action *****************/////
    Route::get('/action/receive/{id}', [ActionController::class, 'receive'])->name('action.receive');
    Route::get('/action/details/{id}', [ActionController::class, 'details'])->name('action.details');
    Route::post('/action/forward', [ActionController::class, 'store'])->name('action.forward');
    Route::post('/action/createsf', [ActionController::class, 'create_sf'])->name('action.createsf');
    Route::post('/action/editsf', [ActionController::class, 'edit_sf'])->name('action.editsf');
    // Route::post('/action/hearingadd', [ActionController::class, 'hearing_add'])->name('action.hearingadd');
    // Route::get('/action/hearingadd', [ActionController::class, 'hearing_add']);
    Route::post('/action/hearingadd', [ActionController::class, 'hearing_store'])->name('action.hearingadd');
    Route::post('/action/file_store_hearing', [ActionController::class, 'file_store_hearing']);
    Route::post('/action/hearing_result_upload', [ActionController::class, 'hearing_result_upload']);

    Route::post('/action/result_update', [ActionController::class, 'result_update'])->name('action.result_update');
    Route::post('/action/action_taken_after_result', [ActionController::class, 'action_taken_after_result'])->name('action.action_taken_after_result');

    Route::get('/action/pdf_sf/{id}', [ActionController::class, 'pdf_sf'])->name('action.pdf_sf');
    Route::get('/action/testpdf', [ActionController::class, 'test_pdf'])->name('action.testpdf');

    // Route::get('ajax-file-upload-progress-bar', 'ProgressBarUploadFileController@index');
    Route::post('/action/file_store', [ActionController::class, 'file_store']);
    Route::post('/action/file_save', [ActionController::class, 'file_save']);
    Route::get('/action/getDependentCaseStatus/{id}', [ActionController::class, 'getDependentCaseStatus']);
    Route::get('/action/getDependentCaseStatusCivilsuit/{id}', [ActionController::class, 'getDependentCaseStatusCivilsuit']);
    // Route::get('file', [FileController::class, 'index']);
    // Route::post('store-file', [FileController::class, 'store']);

    /////*************** Case Register *************/////
	// Route::resource('case', AnimalRegisterController::class);
    Route::get('/animal', [AnimalRegisterController::class, 'index'])->name('case');
    Route::get('/amimal/adult_ox', [AnimalRegisterController::class, 'running_case'])->name('animal.adult_ox');

       
    Route::get('/animal/add', [AnimalRegisterController::class, 'create']);
    Route::post('/animal/save', [AnimalRegisterController::class, 'store']);
    Route::get('/animal/details/{id}', [AnimalRegisterController::class, 'show'])->name('animal.details');
    Route::get('/animal/details_pdf/{id}', [AnimalRegisterController::class, 'details_pdf'])->name('animal.details_pdf');
    Route::get('/animal/edit/{id}', [AnimalRegisterController::class, 'edit'])->name('case.edit');
    Route::post('/animal/update/{id}', [AnimalRegisterController::class, 'update']);


    route::get('/case/dropdownlist/getdependentdistrict/{id}', [AnimalRegisterController::class , 'getDependentDistrict']);
    route::get('/case/dropdownlist/getdependentupazila/{id}', [AnimalRegisterController::class , 'getDependentUpazila']);
    route::get('/case/dropdownlist/getdependentmouja/{id}', [AnimalRegisterController::class , 'getDependentMouja']);
    


    ////********************Other Case Register*****************************///



    /////****************** Report Module *************/////
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/report/case', [ReportController::class, 'caselist'])->name('report.case');
    Route::post('/report/pdf', [ReportController::class, 'pdf_generate']);
    // Route::get('/report/old-case', [ReportController::class, 'old_case']);

    /////****************** Report Module *************/////


    /////****************** RM Report Module *************/////


    /////************** User Management **************/////
    Route::resource('user-management', UserManagementController::class);
    Route::resource('affidavit-committtee', AffidavitController::class);
    Route::resource('advocate-management', AdvocateController::class);
    /////************** MY Profile **************/////
    // Route::resource('my-profile', MyprofileController::class);
    Route::get('/my-profile', [MyprofileController::class, 'index'])->name('my-profile.index');
    Route::get('/my-profile/basic', [MyprofileController::class, 'basic_edit'])->name('my-profile.basic_edit');
    Route::post('/my-profile/basic/update', [MyprofileController::class, 'basic_update'])->name('my-profile.basic_update');
    Route::get('/my-profile/image', [MyprofileController::class, 'imageUpload'])->name('my-profile.imageUpload');
    Route::post('/my-profile/image/update', [MyprofileController::class, 'image_update'])->name('my-profile.image_update');
    Route::get('/my-profile/change-password', [MyprofileController::class, 'change_password'])->name('change.password');
    Route::post('/my-profile/update-password', [MyprofileController::class, 'update_password'])->name('update.password');
    // Route::get('/my-profile', [MyprofileController::class, 'index'])->name('my-profile.index');
    /////************** Office Setting **************/////
    // Route::resource('office-setting', OfficeController::class);
    


    /////************** Office_ULO Setting **************/////
    /////************** Court Setting **************/////
    // Route::resource('court-setting', CourtController::class);
    

    /////************** General Setting **************/////
    // Route::resource('setting', SettingController::class);
    //=======================division===============//
    Route::get('/division', [SettingController::class, 'division_list'])->name('division');
    Route::get('/division/edit/{id}', [SettingController::class, 'division_edit'])->name('division.edit');
    Route::post('/division/update/{id}', [SettingController::class, 'division_update'])->name('division.update');

    //======================= //division===============//
    Route::get('/settings/district', [SettingController::class, 'district_list'])->name('district');
    Route::get('/settings/district/edit/{id}', [SettingController::class, 'district_edit'])->name('district.edit');
    Route::post('/settings/district/update/{id}', [SettingController::class, 'district_update'])->name('district.update');
    Route::get('/settings/upazila', [SettingController::class, 'upazila_list'])->name('upazila');
    Route::get('/settings/upazila/edit/{id}', [SettingController::class, 'upazila_edit'])->name('upazila.edit');
    Route::post('/settings/upazila/update/{id}', [SettingController::class, 'upazila_update'])->name('upazila.update');
    Route::get('/settings/mouja', [SettingController::class, 'mouja_list'])->name('mouja');
    Route::get('/settings/mouja/add', [SettingController::class, 'mouja_add'])->name('mouja-add');
    Route::get('/settings/mouja/edit/{id}', [SettingController::class, 'mouja_edit'])->name('mouja.edit');
    Route::post('/settings/mouja/save', [SettingController::class, 'mouja_save'])->name('mouja.save');
    Route::post('/settings/mouja/update/{id}', [SettingController::class, 'mouja_update'])->name('mouja.update');
   
    /*Route::get('/survey/edit/{id}', [SettingController::class, 'survey_edit'])->name('survey.edit');
    Route::post('/survey/update/{id}', [SettingController::class, 'survey_update'])->name('survey.update');*/
     Route::get('/animal_type', [SettingController::class, 'animal_type_list'])->name('case-type');
     Route::get('/animal_type/add', [SettingController::class, 'animal_type_create'])->name('animal_type.add');
     Route::post('/animal_type/store', [SettingController::class, 'animal_type_store'])->name('animal_type.store');
     Route::get('/animal_type/edit/{id}', [SettingController::class, 'animal_type_edit'])->name('animal_type.edit');
     Route::post('/animal_type/update/{id}', [SettingController::class, 'animal_type_update'])->name('animal_type.update');


     Route::get('/case_status', [SettingController::class, 'case_status_list'])->name('case-status');
     Route::get('/case_status/add', [SettingController::class, 'case_status_add'])->name('case-status.add');
     Route::get('/case_status/details/{id}', [SettingController::class, 'case_status_details'])->name('case-status.details');
     Route::post('/case_status/store', [SettingController::class, 'case_status_store'])->name('case-status.store');
     Route::get('/case_status/edit/{id}', [SettingController::class, 'case_status_edit'])->name('case-status.edit');
     Route::post('/case_status/update/{id}', [SettingController::class, 'case_status_update'])->name('case-status.update');
    /*Route::get('/case_type/edit/{id}', [SettingController::class, 'case_type_edit'])->name('case_type.edit');
    Route::post('/case_type/update/{id}', [SettingController::class, 'case_type_update'])->name('case_type.update');*/
    Route::get('/court_type', [SettingController::class, 'court_type_list'])->name('court-type');
    /*Route::get('/court_type/edit/{id}', [SettingController::class, 'court_type_edit'])->name('court_type.edit');
    Route::post('/court_type/update/{id}', [SettingController::class, 'court_type_update'])->name('court_type.update');*/

    /////************** //General Setting **************/////
    Route::resource('projects', ProjectController::class);
    Route::get('/form-layout', function () {
        return view('form_layout');
    });
    Route::get('/list', function () {
        return view('list');
    });

    //=================== Notification Start ================
    Route::get('/results_completed', [UserNotificationController::class, 'results_completed'])->name('results_completed');
    Route::get('/hearing_date', [UserNotificationController::class, 'hearing_date'])->name('hearing_date');
    Route::get('/rmcase/hearing_date', [UserNotificationController::class, 'rm_hearing_date'])->name('rm_hearing_date');
    Route::get('/new_sf_list', [UserNotificationController::class, 'newSFlist'])->name('newSFlist');
    Route::get('/new_sf_details/{id}', [UserNotificationController::class, 'newSFdetails'])->name('newSFdetails');
    //=================== Notification End ==================

    //=================== Message Start ================
    Route::get('/messages', [MessageController::class, 'messages'])->name('messages');
    Route::get('/messages_recent', [MessageController::class, 'messages_recent'])->name('messages_recent');
    Route::get('/messages_request', [MessageController::class, 'messages_request'])->name('messages_request');
    Route::get('/messages/{id}', [MessageController::class, 'messages_single'])->name('messages_single');
    Route::get('/messages_remove/{id}', [MessageController::class, 'messages_remove'])->name('messages_remove');
    Route::post('/messages/send', [MessageController::class, 'messages_send'])->name('messages_send');
    Route::get('/messages_group', [MessageController::class, 'messages_group'])->name('messages_group');
    // Route::get('/hearing_date', [MessageController::class, 'hearing_date'])->name('hearing_date');
    // Route::get('/new_sf_list', [MessageController::class, 'newSFlist'])->name('newSFlist');
    // Route::get('/new_sf_details/{id}', [MessageController::class, 'newSFdetails'])->name('newSFdetails');
    //=================== Message End ==================
    Route::get('/script', [MessageController::class, 'script']);


    //CivilSuit-v2 AT Case Route start from here
   
    // URL::forceScheme('https');
});
