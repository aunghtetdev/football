<?php

use App\Models\WalletHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\BetController;
use App\Http\Controllers\Admin\OddController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MatchController;
use App\Http\Controllers\Admin\LeagueController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\OddMoungController;
use App\Http\Controllers\Admin\TotalBetController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\MatchMoungController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TotalBetBodyController;
use App\Http\Controllers\Admin\TotalBetMoungController;
use App\Http\Controllers\Admin\WalletHistoryController;
use App\Http\Controllers\Frontend\CompensationController;
use App\Http\Controllers\Admin\TotalBetBodyHistoryController;

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
    return view('auth.login');
});

Auth::routes(['register'=>false]);
Route::middleware('auth')->group(function () {
    //Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/match/bet-match', [CompensationController::class, 'betMatch'])->name('match.bet-match');

    Route::get('/match/moung', [CompensationController::class, 'showMoung'])->name('match.moung');
    Route::post('/match/bet-moung', [CompensationController::class, 'betMoung'])->name('match.bet-moung');

    Route::get('/match/body', [CompensationController::class, 'showBody'])->name('match.body');

    Route::get('/match/previous-bet', [CompensationController::class, 'showPreviousBet'])->name('match.previous-bet');
    Route::post('/match/filter-previous-bet', [CompensationController::class, 'filterPreviousBet'])->name('match.filter-previous-bet');
    Route::get('/match/active-bet', [CompensationController::class, 'showActiveBet'])->name('match.active-bet');

    Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');

});

Route::get('/admin/login', [AdminLoginController::class,'showLoginForm']);
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login');
Route::post('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');


Route::middleware('auth')->group(function () {
    Route::get('/home/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/home/profile/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('change_password');
    Route::get('/history', [App\Http\Controllers\HomeController::class, 'history']);
    Route::get('/history/thwin_ngwe/{id}/{startDate}/{endDate}', [App\Http\Controllers\HomeController::class, 'thwinNgwe']);
    Route::get('/history/htote_ngwe/{id}/{startDate}/{endDate}', [App\Http\Controllers\HomeController::class, 'htoteNgwe']);
    Route::get('/history/laung_ngwe/{id}/{startDate}/{endDate}', [App\Http\Controllers\HomeController::class, 'laungNgwe']);
    Route::get('/history/pyan_ya_ngwe/{id}/{startDate}/{endDate}', [App\Http\Controllers\HomeController::class, 'pyanYaNgwe']);
});

Route::get('/admin/login', [AdminLoginController::class,'showLoginForm']);
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login');
Route::post('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('home', AdminUserController::class);
    Route::get('/home/datatables/ssd', [AdminUserController::class,'ssd']);

    Route::resource('/users', UserController::class);
    Route::get('/users/datatables/ssd', [UserController::class,'ssd']);

    Route::resource('matches', MatchController::class);
    Route::get('/matches/datatables/ssd', [MatchController::class,'ssd']);

    Route::resource('/moung', MatchMoungController::class);
    Route::get('/moung/datatables/ssd', [MatchMoungController::class,'ssd']);

    Route::resource('odds', OddController::class);
    Route::get('/odds/change-odds/{odd_id}', [OddController::class, 'changeOdds']);
    Route::post('/odds/save-change-odds', [OddController::class, 'saveChangeOdds'])->name('odds.save-change-odds');
    Route::get('/odds/datatables/ssd', [OddController::class,'ssd']);
    Route::post('/match/teams', [OddController::class,'getAjaxMatchTeam']);
    
    Route::resource('odds-moung', OddMoungController::class);
    Route::get('/odds-moung/datatables/ssd', [OddMoungController::class,'ssd']);
    Route::post('/match-moung-teams', [OddMoungController::class,'getAjaxMatchTeam']);

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


    Route::get('/bets/total-body',[TotalBetBodyController::class,'index']);
    Route::get('/bets-body/{match_id}/{bet_team_id}',[TotalBetBodyController::class,'overUnderTeam']);
    Route::get('/{match_id}/over-goal',[TotalBetBodyController::class,'overGoal']);
    Route::get('/{match_id}/under-goal',[TotalBetBodyController::class,'underGoal']);


    Route::get('/bets-history/total-body',[TotalBetBodyHistoryController::class,'index']);
    Route::get('/bets-history/total-body/datatables/ssd',[TotalBetBodyHistoryController::class,'ssd']);

    Route::get('/bets/total-moung',[TotalBetMoungController::class,'index']);
    Route::get('/bets-moung',[TotalBetMoungController::class,'betting']);

    Route::get('/bets', [BetController::class, 'index']);
    Route::get('/bets/datatables/ssd', [BetController::class,'ssd']);
    Route::get('/bets/bet-details/{user_id}', [BetController::class,'betDetails']);
    Route::post('/bets/bet-details/compensation', [BetController::class,'saveCompensation']);

    //Route::get('/bets/total-body/',[TotalBetController::class,'index']);
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/feedbacks/datatables/ssd', [FeedbackController::class,'ssd']);
});