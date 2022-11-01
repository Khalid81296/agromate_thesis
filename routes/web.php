<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\Office_ULOController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\CaseRegisterController;
use App\Http\Controllers\OtherCaseRegisterController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AffidavitController;
use App\Http\Controllers\AdvocateController;
use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Writ_ReportController;
use App\Http\Controllers\RM_ReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PagesController;
use App\Models\CaseActivityLog;
use App\Http\Controllers\CaseActivityLogController;
use App\Http\Controllers\UserNotificationController;
Use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MinarController;
use App\Http\Controllers\AtCaseRegisterController;
use App\Http\Controllers\AtCaseActionController;
use App\Http\Controllers\RM_CaseActionController;
use App\Http\Controllers\RM_CaseRegisterController;
use App\Http\Controllers\RM_CaseActivityLogController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\WritCaseController;
use App\Http\Controllers\Writ_CaseActionController;
use App\Http\Controllers\Writ_CaseActivityLogController;

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
// Route::get('public_home', [FrontHomeController::class, 'public_home']);
Route::get('/', [FrontHomeController::class, 'public_home']);
Route::get('cabinet/create', [CabinetController::class, 'create']);
Route::get('hearing-case-list', [FrontHomeController::class, 'dateWaysCase'])->name('dateWaysCase');
Route::get('writ-hearing-case-list', [FrontHomeController::class, 'dateWaysWritCase'])->name('dateWaysWritCase');
Route::get('rm-case-hearing-list', [FrontHomeController::class, 'dateWaysRMCase'])->name('dateWaysRMCase');
Route::get('rm-case-hearing-details/{id}', [FrontHomeController::class, 'rm_show'])->name('dateWaysRMCaseDetails');
Route::get('case-hearing-details/{id}', [FrontHomeController::class, 'hearing_case_details'])->name('dateWaysCaseDetails');
Route::get('writ-case-hearing-details/{id}', [FrontHomeController::class, 'writ_case_hearing_details'])->name('dateWaysWritCaseDetails');

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
	// Route::resource('case', CaseRegisterController::class);
    Route::get('/case', [CaseRegisterController::class, 'index'])->name('case');
    Route::get('/case/running_case', [CaseRegisterController::class, 'running_case'])->name('case.running');
    Route::get('/case/appeal_case', [CaseRegisterController::class, 'appeal_case'])->name('case.appeal');
    Route::get('/case/complete_case', [CaseRegisterController::class, 'complete_case'])->name('case.complete');

        //===================Old Running Case===========//
    Route::get('/case/old/running', [CaseRegisterController::class, 'old_running_case'])->name('case.old.running');
    Route::get('/case/old/running/create', [CaseRegisterController::class, 'create_old_running_case']);
    Route::post('/case/old/running/save', [CaseRegisterController::class, 'store_old_running_case']);

        //===================//Old Running Case===========//
    Route::get('/case/old', [CaseRegisterController::class, 'old_case'])->name('case.old');
    Route::get('/case/add', [CaseRegisterController::class, 'create']);
    Route::get('/case/create', [CaseRegisterController::class, 'old_case_create']);
    Route::post('/case/save', [CaseRegisterController::class, 'store']);
    Route::post('/case/saved', [CaseRegisterController::class, 'old_case_store']);
    Route::post('/case/appeal/save/{id}', [CaseRegisterController::class, 'store_appeal_case']);
    Route::get('/case/details/{id}', [CaseRegisterController::class, 'show'])->name('case.details');
    Route::get('/case/details_pdf/{id}', [CaseRegisterController::class, 'details_pdf'])->name('case.details_pdf');
    Route::get('/case/sflog/details/{id}', [CaseRegisterController::class, 'sflog_details'])->name('case.sflog.details');
    Route::get('/case/edit/{id}', [CaseRegisterController::class, 'edit'])->name('case.edit');
    Route::get('/case/old/edit/{id}', [CaseRegisterController::class, 'old_case_edit'])->name('case.old_edit');
    Route::post('/case/update/{id}', [CaseRegisterController::class, 'update']);
    Route::post('/case/old/update/{id}', [CaseRegisterController::class, 'old_case_update'])->name('case.old_update');
    Route::get('/case/appeal/create/{id}', [CaseRegisterController::class, 'create_appeal_case'])->name('case.create_appeal');
    route::get('/case/dropdownlist/getdependentdistrict/{id}', [CaseRegisterController::class , 'getDependentDistrict']);
    route::get('/case/dropdownlist/getdependentupazila/{id}', [CaseRegisterController::class , 'getDependentUpazila']);
    route::get('/case/dropdownlist/getdependentoffice/{id}', [CaseRegisterController::class , 'getDependentOffice']);
    route::get('/case/dropdownlist/getdependentdistrictoffice/{id}', [CaseRegisterController::class , 'getDependentDistrictOffice']);
    route::get('/case/dropdownlist/getdependentupazilaoffice/{id}', [CaseRegisterController::class , 'getDependentUpazilaOffice']);
    route::get('/court/dropdownlist/getdependentcourt/{id}', [CaseRegisterController::class , 'getDependentCourt']);
    route::get('/case/dropdownlist/getdependentmouja/{id}', [CaseRegisterController::class , 'getDependentMouja']);
    route::get('/case/dropdownlist/getdependentgp/{id}', [CaseRegisterController::class , 'getDependentGp']);
    route::get('/case/dropdownlist/getdependentappealcourt/{id}', [CaseRegisterController::class , 'getDependentAppealCourt']);
    route::get('/case/dropdownlist/getdependentoldcasecourt/{id}', [CaseRegisterController::class , 'getDependentOldCaseCourt']);
    route::get('/case/dropdownlist/getdependentoldcaseno/{id}', [CaseRegisterController::class , 'getDependentOldCaseID']);
    route::get('/case/dropdownlist/getdependentoldpreviouscaseno/{id}', [CaseRegisterController::class , 'getDependentOldPreviousCaseID']);
    route::post('/case/ajax_badi_del/{id}', [CaseRegisterController::class , 'ajaxBadiDelete']);
    route::post('/case/ajax_bibadi_del/{id}', [CaseRegisterController::class , 'ajaxBibadiDelete']);
    route::post('/case/ajax_survey_del/{id}', [CaseRegisterController::class , 'ajaxSurvayDelete']);


    ////********************Other Case Register*****************************///
    Route::get('/other/case/writ/create', [OtherCaseRegisterController::class, 'writ_create'])->name('other.case.writ');
    Route::get('/other/case/contempt/create', [OtherCaseRegisterController::class, 'contempt_create'])->name('other.case.contempt');
    Route::get('/other/case/review/create', [OtherCaseRegisterController::class, 'review_create'])->name('other.case.review');



    /////****************** Report Module *************/////
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/report/case', [ReportController::class, 'caselist'])->name('report.case');
    Route::post('/report/pdf', [ReportController::class, 'pdf_generate']);
    // Route::get('/report/old-case', [ReportController::class, 'old_case']);

    /////****************** Report Module *************/////
    Route::get('/writcase/report', [Writ_ReportController::class, 'index'])->name('writcase.report');
    Route::get('/writcase/report/case', [Writ_ReportController::class, 'caselist'])->name('writcase.report.case');
    Route::post('/writcase/report/pdf', [Writ_ReportController::class, 'pdf_generate']);
    // Route::get('/report/old-case', [Writ_ReportController::class, 'old_case']);


    /////****************** RM Report Module *************/////
    Route::get('/rmcase/report', [RM_ReportController::class, 'index'])->name('rmcase.report');
    Route::get('/rmcase/report/caselist', [RM_ReportController::class, 'caselist'])->name('rmcase.report.rmcaselist');
    Route::post('/rmcase/report/pdf', [RM_ReportController::class, 'pdf_generate']);
    // Route::get('/report/old-case', [RM_ReportController::class, 'old_case']);

    //============ Case Activity Log Start ==============//
    Route::get('/case_audit', [CaseActivityLogController::class, 'index'])->name('case_audit.index');
    Route::get('/case_audit/details/{id}', [CaseActivityLogController::class, 'show'])->name('case_audit.show');
    Route::get('/case_audit/pdf-Log/{id}', [CaseActivityLogController::class, 'caseActivityPDFlog'])->name('case_audit.caseActivityPDFlog');
    Route::get('/case_audit/case_details/{id}', [CaseActivityLogController::class, 'reg_case_details'])->name('case_audit.reg_case_details');
    Route::get('/case_audit/sf/details/{id}', [CaseActivityLogController::class, 'sflog_details'])->name('case_audit.sf.details');
    //============ Case Activity Log End ==============//


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
    Route::get('/office', [OfficeController::class, 'index'])->name('office');
    route::get('/office/create', [OfficeController::class, 'create'])->name('office.create');
      Route::post('/office/save', [OfficeController::class, 'store'])->name('office.save');
    route::get('/office/edit/{id}', [OfficeController::class, 'edit'])->name('office.edit');
    route::post('/office/update/{id}', [OfficeController::class, 'update'])->name('office.update');
    route::get('/office/dropdownlist/getdependentdistrict/{id}', [OfficeController::class , 'getDependentDistrict']);
    route::get('/office/dropdownlist/getdependentupazila/{id}', [OfficeController::class , 'getDependentUpazila']);


    /////************** Office_ULO Setting **************/////
    // Route::resource('office_ulo-setting', Office_ULOController::class);
    Route::get('/ulo', [Office_ULOController::class, 'index'])->name('ulo');
    route::get('/ulo/create', [Office_ULOController::class, 'create'])->name('ulo.create');
    route::post('/ulo/save', [Office_ULOController::class, 'store'])->name('ulo.save');
    route::get('/ulo/edit/{id}', [Office_ULOController::class, 'edit'])->name('ulo.edit');
    route::post('/ulo/update/{id}', [Office_ULOController::class, 'update'])->name('ulo.update');
    route::get('/ulo/dropdownlist/getdependentdistrict/{id}', [Office_ULOController::class , 'getDependentDistrict']);
    route::get('/ulo/dropdownlist/getdependentupazila/{id}', [Office_ULOController::class , 'getDependentUpazila']);
    route::get('/ulo/dropdownlist/getdependentulo/{id}', [Office_ULOController::class , 'getDependentULO']);
    /////************** Court Setting **************/////
    // Route::resource('court-setting', CourtController::class);
    route::get('/court', [CourtController::class, 'index'])->name('court');
    route::get('/court/create', [CourtController::class, 'create'])->name('court.create');
    Route::post('/court/save', [CourtController::class, 'store'])->name('court.save');
    route::get('/court/edit/{id}', [CourtController::class, 'edit'])->name('court.edit');
    route::post('/court/update/{id}', [CourtController::class, 'update'])->name('court.update');
    route::get('/court-setting/dropdownlist/getdependentdistrict/{id}', [CourtController::class , 'getDependentDistrict']);

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
    Route::get('/settings/survey', [SettingController::class, 'survey_type_list'])->name('survey');
    /*Route::get('/survey/edit/{id}', [SettingController::class, 'survey_edit'])->name('survey.edit');
    Route::post('/survey/update/{id}', [SettingController::class, 'survey_update'])->name('survey.update');*/
     Route::get('/case_type', [SettingController::class, 'case_type_list'])->name('case-type');
     Route::get('/case_type/add', [SettingController::class, 'case_type_create'])->name('case_type.add');
     Route::post('/case_type/store', [SettingController::class, 'case_type_store'])->name('case_type.store');
     Route::get('/case_type/edit/{id}', [SettingController::class, 'case_type_edit'])->name('case_type.edit');
     Route::post('/case_type/update/{id}', [SettingController::class, 'case_type_update'])->name('case_type.update');


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
    Route::group(['prefix' => 'atcase/', 'as' => 'atcase.'], function () {
    /********************AT Case Register Start*****************************/
        Route::get('create', [AtCaseRegisterController::class, 'create'])->name('create');
        Route::get('index', [AtCaseRegisterController::class, 'index'])->name('index');
        Route::post('store', [AtCaseRegisterController::class, 'store'])->name('store');
        Route::get('show/{id}', [AtCaseRegisterController::class, 'show'])->name('show');
        Route::get('edit/{id}', [AtCaseRegisterController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [AtCaseRegisterController::class, 'update'])->name('update');
        Route::post('ajax_badi_del/{id}', [AtCaseRegisterController::class , 'ajaxBadiDelete']);
        Route::post('ajax_bibadi_del/{id}', [AtCaseRegisterController::class , 'ajaxBibadiDelete']);
        Route::post('ajax_order_del/{id}', [AtCaseRegisterController::class , 'ajaxOrderDelete']);
        Route::post('ajax_judge_del/{id}', [AtCaseRegisterController::class , 'ajaxJudgeDelete']);

        /******************** // AT Case Register End *****************************/

        /////*******************  Action Start *****************/////
        Route::group(['prefix' => 'action/', 'as' => 'action.'], function () {
            Route::get('receive/{id}', [AtCaseActionController::class, 'receive'])->name('receive');
            Route::get('details/{id}', [AtCaseActionController::class, 'details'])->name('details');
            Route::post('forward', [AtCaseActionController::class, 'store'])->name('forward');
            Route::post('createsf', [AtCaseActionController::class, 'create_sf'])->name('createsf');
            Route::post('editsf', [AtCaseActionController::class, 'edit_sf'])->name('editsf');
            Route::post('hearingadd', [AtCaseActionController::class, 'hearing_store'])->name('hearingadd');
            Route::post('file_store_hearing', [AtCaseActionController::class, 'file_store_hearing'])->name('file_store_hearing');
            Route::post('result_update', [AtCaseActionController::class, 'result_update'])->name('result_update');
            Route::get('pdf_sf/{id}', [AtCaseActionController::class, 'pdf_sf'])->name('pdf_sf');
            Route::get('testpdf', [AtCaseActionController::class, 'test_pdf'])->name('testpdf');
            Route::post('file_store', [AtCaseActionController::class, 'file_store'])->name('file_store');
            Route::post('file_save', [AtCaseActionController::class, 'file_save']);
            Route::get('getDependentCaseStatus/{id}', [AtCaseActionController::class, 'getDependentCaseStatus']);
        });
        /////******************* // Action End *****************/////
    });

    //CivilSuit-v2 RM Case Route start from here
    Route::group(['prefix' => 'rmcase/', 'as' => 'rmcase.'], function () {
    /********************AT Case Register Start*****************************/
        Route::get('create', [RM_CaseRegisterController::class, 'create'])->name('create');
        Route::get('index', [RM_CaseRegisterController::class, 'index'])->name('index');
        Route::get('running_case', [RM_CaseRegisterController::class, 'running_case'])->name('running_case');
        Route::get('complete_case', [RM_CaseRegisterController::class, 'complete_case'])->name('complete_case');
        Route::post('store', [RM_CaseRegisterController::class, 'store'])->name('store');
        Route::get('show/{id}', [RM_CaseRegisterController::class, 'show'])->name('show');
        Route::get('edit/{id}', [RM_CaseRegisterController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [RM_CaseRegisterController::class, 'update'])->name('update');
        Route::post('ajax_badi_del/{id}', [RM_CaseRegisterController::class , 'ajaxBadiDelete']);
        Route::post('ajax_bibadi_del/{id}', [RM_CaseRegisterController::class , 'ajaxBibadiDelete']);
        Route::post('ajax_file_del/{id}', [RM_CaseRegisterController::class , 'ajaxFileDelete']);
        Route::post('ajax_order_del/{id}', [RM_CaseRegisterController::class , 'ajaxOrderDelete']);
        Route::post('ajax_judge_del/{id}', [RM_CaseRegisterController::class , 'ajaxJudgeDelete']);
        Route::get('appeal/create/{id}', [RM_CaseRegisterController::class, 'create_appeal'])->name('create_appeal');
        Route::post('appeal/store/{id}', [RM_CaseRegisterController::class, 'store_appeal'])->name('store_appeal');


        /******************** // AT Case Register End *****************************/

        /////*******************  Action Start *****************/////
        Route::group(['prefix' => 'action/', 'as' => 'action.'], function () {
            Route::get('receive/{id}', [RM_CaseActionController::class, 'receive'])->name('receive');
            Route::get('details/{id}', [RM_CaseActionController::class, 'details'])->name('details');
            Route::post('forward', [RM_CaseActionController::class, 'store'])->name('forward');
            Route::post('createsf', [RM_CaseActionController::class, 'create_sf'])->name('createsf');
            Route::post('editsf', [RM_CaseActionController::class, 'edit_sf'])->name('editsf');
            Route::post('hearingadd', [RM_CaseActionController::class, 'hearing_store'])->name('hearingadd');
            Route::post('file_store_hearing', [RM_CaseActionController::class, 'file_store_hearing'])->name('file_store_hearing');
            Route::post('hearing_result_upload', [RM_CaseActionController::class, 'hearing_result_upload'])->name('hearing_result_upload');
            Route::post('result_update', [RM_CaseActionController::class, 'result_update'])->name('result_update');
            Route::get('pdf_sf/{id}', [RM_CaseActionController::class, 'pdf_sf'])->name('pdf_sf');
            Route::get('testpdf', [RM_CaseActionController::class, 'test_pdf'])->name('testpdf');
            Route::post('file_store', [RM_CaseActionController::class, 'file_store'])->name('file_store');
            Route::post('file_save', [RM_CaseActionController::class, 'file_save']);
            Route::get('getDependentCaseStatus/{id}', [RM_CaseActionController::class, 'getDependentCaseStatus']);
        });
        /////******************* // Action End *****************/////

        //============ RM Case Activity Log Start ==============//
        Route::get('/case_audit', [RM_CaseActivityLogController::class, 'index'])->name('case_audit.index');
        Route::get('/case_audit/details/{id}', [RM_CaseActivityLogController::class, 'show'])->name('case_audit.show');
        Route::get('/case_audit/pdf-Log/{id}', [RM_CaseActivityLogController::class, 'caseActivityPDFlog'])->name('case_audit.caseActivityPDFlog');
        Route::get('/case_audit/case_details/{id}', [RM_CaseActivityLogController::class, 'reg_case_details'])->name('case_audit.reg_case_details');
        Route::get('/case_audit/sf/details/{id}', [RM_CaseActivityLogController::class, 'sflog_details'])->name('case_audit.sf.details');
        //============ RM Case Activity Log End ==============//
    });

    //CivilSuit-v2 Writ Case Route start from here
    Route::group(['prefix' => 'writcase/', 'as' => 'writcase.'], function () {
    /********************Writ Case Register Start*****************************/
        Route::get('create', [WritCaseController::class, 'create'])->name('create');
        Route::get('index', [WritCaseController::class, 'index'])->name('index');
        Route::post('store', [WritCaseController::class, 'store'])->name('store');
        Route::get('details/{id}', [WritCaseController::class, 'show'])->name('show');
        Route::get('edit/{id}', [WritCaseController::class, 'edit'])->name('edit');
        Route::get('sflog/details/{id}', [WritCaseController::class, 'sflog_details'])->name('sflog.details');
        Route::get('/dropdownlist/getdependentdistrict/{id}', [WritCaseController::class , 'getDependentDistrict']);
        Route::get('/dropdownlist/getdependentupazila/{id}', [WritCaseController::class , 'getDependentUpazila']);
            
        

        /////*******************  Action Start *****************/////
        Route::group(['prefix' => 'action/', 'as' => 'action.'], function () {
            Route::get('/receive/{id}', [Writ_CaseActionController::class, 'receive'])->name('receive');
            Route::get('/details/{id}', [Writ_CaseActionController::class, 'details'])->name('details');
            Route::post('/forward', [Writ_CaseActionController::class, 'store'])->name('forward');
            Route::post('/createsf', [Writ_CaseActionController::class, 'create_sf'])->name('createsf');
            Route::post('/editsf', [Writ_CaseActionController::class, 'edit_sf'])->name('editsf');
            Route::post('/hearingadd', [Writ_CaseActionController::class, 'hearing_store'])->name('hearingadd');
             Route::post('/file_store_hearing', [Writ_CaseActionController::class, 'file_store_hearing']);

            Route::post('/result_update', [Writ_CaseActionController::class, 'result_update'])->name('result_update');
            Route::get('/pdf_sf/{id}', [Writ_CaseActionController::class, 'pdf_sf'])->name('pdf_sf');
            Route::get('/testpdf', [Writ_CaseActionController::class, 'test_pdf'])->name('testpdf');
            Route::post('/file_store', [Writ_CaseActionController::class, 'file_store']);
            Route::post('/file_save', [Writ_CaseActionController::class, 'file_save']);
            Route::post('/affidavit_committtee_save', [Writ_CaseActionController::class, 'affidavit_committtee_save']);
            Route::get('/getDependentCaseStatus/{id}', [Writ_CaseActionController::class, 'getDependentCaseStatus']);
        });
        /////******************* // Action End *****************/////

    //============ Case Activity Log Start ==============//
    Route::get('/case_audit', [Writ_CaseActivityLogController::class, 'index'])->name('case_audit.index');
    Route::get('/case_audit/details/{id}', [Writ_CaseActivityLogController::class, 'show'])->name('case_audit.show');
    Route::get('/case_audit/pdf-Log/{id}', [Writ_CaseActivityLogController::class, 'caseActivityPDFlog'])->name('case_audit.caseActivityPDFlog');
    Route::get('/case_audit/case_details/{id}', [Writ_CaseActivityLogController::class, 'reg_case_details'])->name('case_audit.reg_case_details');
    Route::get('/case_audit/sf/details/{id}', [Writ_CaseActivityLogController::class, 'sflog_details'])->name('case_audit.sf.details');
    //============ Case Activity Log End ==============//
    });
    // URL::forceScheme('https');
});
