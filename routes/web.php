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
    Route::get('showMyPlan/{id}', [MapController::class, 'showNowRegisteredPlan'])->name('showNowRegisteredPlan');
    Route::get('showMyPlan', [MapController::class, 'showMyPlan'])->name('showMyPlan');
    Route::get('planPage', [MapController::class, 'showPlanPage'])->name('showPlanPage');

});
Route::prefix('admins')->middleware('auth:admins')->group(function() {
    Route::get('register', [MultiAuthController::class, 'registerAdmin'])->name('registerAdmin');
    Route::post('confirmRegister',[MultiAuthController::class, 'confirmAdminRegister'])->name('confirmAdminRegister');
    Route::post('completeRegister', [MultiAuthController::class, 'completeAdminRegister'])->name('completeAdminRegister');
    Route::post('reAuth', [AdminController::class, 'reAuth'])->name('reAuth');
});
Route::get('/show_MyPlan/{id}', [ApiController::class, 'showSelectedPlan'])->middleware('auth:users');
Route::post('/registerPlanDetail', [ApiController::class, 'registerPlanDetail'])->middleware('auth:users');
Route::get('/deletePlanDetail/{id}', [ApiController::class, 'deletePlanDetail'])->middleware(('auth:users'));
Route::post('/updatePlanDetail', [ApiController::class, 'updatePlanDetail'])->middleware(('auth:users'));
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
