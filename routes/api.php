<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
https://www.itsolutionstuff.com/post/laravel-8-rest-api-with-passport-authentication-tutorialexample.html
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
*/

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\CaseRegisterController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [LoginController::class, 'login']);

// With Auth
Route::middleware('auth:api')->group( function () {

    // Route::get('/dashboard/hearing-tomorrow', [DashboardController::class, 'hearing_date_tomorrow'])->name('dashboard.hearing-tomorrow');
    // Route::get('/dashboard/hearing-nextWeek', [DashboardController::class, 'hearing_date_nextWeek'])->name('dashboard.hearing-nextWeek');
    // Route::get('/dashboard/hearing-nextMonth', [DashboardController::class, 'hearing_date_nextMonth'])->name('dashboard.hearing-nextMonth');

	Route::get('case', [CaseRegisterController::class, 'index'])->name('case.index');
	Route::get('case/all-case', [CaseRegisterController::class, 'all_case'])->name('case.all-case');
	Route::get('case/all', [CaseRegisterController::class, 'case_list'])->name('case.all');
	Route::get('case/details/{id}', [CaseRegisterController::class, 'details'])->name('case.details.id');
	Route::get('case/test', [CaseRegisterController::class, 'test'])->name('case.tests');
	Route::get('case/dashboard', [CaseRegisterController::class, 'dashboard'])->name('case.dashboard');
	Route::get('case/case-tracking', [CaseRegisterController::class, 'case_tracking'])->name('case.case_tracking');
    Route::get('case/hearing-date', [CaseRegisterController::class, 'hearing_date'])->name('case.hearing_date');

	Route::get('profile/details/{id}', [ProfileController::class, 'details'])->name('profile.details');
	Route::post('profile/update_password', [ProfileController::class, 'update_password'])->name('profile.update_password');
	Route::post('profile/profile_picture', [ProfileController::class, 'profile_picture'])->name('profile.profile_picture');
	Route::get('setting/division', [SettingsController::class, 'division_list'])->name('setting.division');
	Route::get('setting/district/{id}', [SettingsController::class, 'district_list'])->name('setting.district');
	Route::get('setting/upazila/{id}', [SettingsController::class, 'upazila_list'])->name('setting.upazila');
	Route::get('setting/court/{id}', [SettingsController::class, 'court_list'])->name('setting.court');

	Route::get('notification/notify', [NotificationController::class, 'notify'])->name('notification.notify');

	Route::get('/messages/user-list', [MessageController::class, 'messages'])->name('messages.users');
    Route::get('/messages/single/{id}', [MessageController::class, 'messages_single'])->name('messages.single');
    Route::get('/messages/recent', [MessageController::class, 'messages_recent'])->name('messages.recent');
    Route::get('/messages/request', [MessageController::class, 'messages_request'])->name('messages.request');
    Route::get('/messages/remove/{id}', [MessageController::class, 'messages_remove'])->name('messages.remove');
    Route::post('/messages/send', [MessageController::class, 'messages_send'])->name('messages.send');
    Route::get('messages/groups', [MessageController::class, 'messages_groups'])->name('messages.groups');
});


/*
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
});
*/

/*
// OLd Route
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

