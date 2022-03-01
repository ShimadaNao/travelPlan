<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MultiAuthController;

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

Route::get('multi_login', [MultiAuthController::class, 'showLoginForm'])->name('multi_login');
Route::post('multi_login', [MultiAuthController::class, 'login']);

// ログイン後のページ
Route::prefix('users')->middleware('auth:users')->group(function () {
    Route::get('dashboard', [MultiAuthController::class, 'showUserDashboard'])->name('userDashboard');
    Route::post('registerTravelTitle', [MapController::class, 'registerTravelTitle'])->name('registerTravelTitle');
    Route::get('showMyPlan/{id}', [MapController::class, 'showSelectedPlanMap'])->name('showSelectedPlanMap');
    Route::get('showMyPlan', [MapController::class, 'showMyPlan'])->name('showMyPlan');
    Route::get('plansCharts', [MapController::class, 'showPlanCharts'])->name('planCharts');
    Route::get('planChartDetails/{id}', [MapController::class, 'showPlanChartDetails'])->name('planChartDetails');
    Route::get('calendar', [ApiController::class, 'showCalendar'])->name('calendar');
    Route::get('registerPlan', [MapController::class, 'showRegisterPlanForm'])->name('registerPlanForm');
    Route::get('deletePlan/{id}', [MapController::class, 'deletePlan'])->name('deletePlan');
    Route::get('ranking', [MapController::class, 'showPopularCountryRanking'])->name('countryRanking');
    Route::get('sharedPlans', [MapController::class, 'showSharedPlans'])->name('sharedPlans');
    Route::get('sharedPlansCountry/{id}', [MapController::class, 'showItsSharedPlans'])->name('itsSharedPlan');
});
Route::prefix('admins')->middleware('auth:admins')->group(function() {
    Route::get('register', [MultiAuthController::class, 'registerAdmin'])->name('registerAdmin');
    Route::post('confirmRegister',[MultiAuthController::class, 'confirmAdminRegister'])->name('confirmAdminRegister');
    Route::post('completeRegister', [MultiAuthController::class, 'completeAdminRegister'])->name('completeAdminRegister');
    Route::post('reAuth', [AdminController::class, 'reAuth'])->name('reAuth');
    Route::view('planSearch', 'admin.planSearch')->name('planSearchPage');
    Route::get('planSearchResult', [AdminController::class, 'showPlanSearchResult'])->name('planSearchResult');
    Route::get('planSearchResultDetail/{id}', [AdminController::class, 'showPlanSearchResultDetail'])->name('planSearchResultDetail');
});
Route::middleware('auth:users')->group(function() {
    Route::get('/show_MyPlan/{id}', [ApiController::class, 'showSelectedPlan']);
    Route::post('/registerPlanDetail', [ApiController::class, 'registerPlanDetail']);
    Route::get('/deletePlanDetail/{id}', [ApiController::class, 'deletePlanDetail']);
    Route::post('/updatePlanDetail', [ApiController::class, 'updatePlanDetail']);
    Route::post('/confirmExcludableDetail', [ApiController::class, 'confirmExcludablePlanDetails']);
    Route::post('/updatePlan', [ApiController::class, 'updatePlan'])->name('updatePlan');
});

Route::prefix('admins')->middleware('auth:admins')->group(function () {
    Route::get('dashboard', [MultiAuthController::class, 'showAdminDashboard'])->name('adminDashboard');
});

// Route::get('/', function () {
//     return view('top');
// });

Route::get('/', [MapController::class, 'showTopPage'])->name('showTopPage');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
