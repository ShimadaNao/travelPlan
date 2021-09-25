<?php

use Illuminate\Support\Facades\Route;

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

Route::get('multi_login', [\App\Http\Controllers\MultiAuthController::class, 'showLoginForm'])->name('multi_login');
Route::post('multi_login', [\App\Http\Controllers\MultiAuthController::class, 'login']);

// ログアウト
Route::get('multi_login/logout', [\App\Http\Controllers\MultiAuthController::class, 'logout'])->name('multi_logout');

// ログイン後のページ
Route::prefix('users')->middleware('auth:users')->group(function(){

 Route::get('dashboard', function(){ return 'ユーザーでログイン完了'; });

});
Route::prefix('admins')->middleware('auth:admins')->group(function(){

 Route::get('dashboard', function(){ return '管理者でログイン完了'; });

});


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
