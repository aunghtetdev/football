<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AdminLoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/login', [AdminLoginController::class,'showLoginForm']);
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login');
Route::post('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::resource('home', AdminUserController::class);
    Route::get('/home/datatables/ssd', [AdminUserController::class,'ssd']);
    Route::resource('users', UserController::class);
    Route::get('/users/datatables/ssd', [UserController::class,'ssd']);
});
