<?php

use App\Models\WalletHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OddController;
use App\Http\Controllers\Admin\MatchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LeagueController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\WalletHistoryController;

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

    Route::resource('/users', UserController::class);
    Route::get('/users/datatables/ssd', [UserController::class,'ssd']);

    Route::resource('matches', MatchController::class);
    Route::get('/matches/datatables/ssd', [MatchController::class,'ssd']);

    Route::resource('odds', OddController::class);
    Route::get('/odds/datatables/ssd', [OddController::class,'ssd']);
    
    Route::post('/match/teams', [OddController::class,'getAjaxMatchTeam']);
    Route::resource('/leagues', LeagueController::class);
    Route::post('/leagues/toggle/{toggle}', [LeagueController::class, 'toggle']);
    Route::get('/leagues/datatables/ssd', [LeagueController::class,'ssd']);

    Route::resource('/teams', TeamController::class);
    Route::get('/teams/datatables/ssd', [TeamController::class,'ssd']);

    Route::get('/wallets', [WalletController::class,'index']);
    Route::get('/wallets/datatables/ssd', [WalletController::class,'ssd']);
    Route::get('/wallets/{id}/add', [WalletController::class,'add']);
    Route::post('/wallets/{id}/store', [WalletController::class,'store']);
    Route::get('/wallets/{id}/substract', [WalletController::class,'substract']);
    Route::post('/wallets/{id}/extract', [WalletController::class,'extract']);

    Route::get('/wallets/history', [WalletHistoryController::class , 'index']);
    Route::get('/wallets/history/datatables/ssd', [WalletHistoryController::class , 'ssd']);

    Route::resource('/permissions', PermissionController::class);
    Route::get('/permissions/datatables/ssd', [PermissionController::class,'ssd']);

    Route::resource('/roles', RoleController::class);
    Route::get('/roles/datatables/ssd', [RoleController::class,'ssd']);
});
