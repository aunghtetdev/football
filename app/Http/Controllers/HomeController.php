<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bet;
use App\Models\Wallet;
use App\Models\Fixture;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\WalletHistoryController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $now = Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s');
        $matches = Fixture::join('odds', 'fixtures.id', '=', 'odds.match_id')
            ->join('live_odds', 'odds.id', '=', 'live_odds.odd_id')
            ->where('live_odds.live', 1)
            ->where('fixtures.finished', 0)
            ->where('fixtures.date', '>', $now)
            ->orderBy('date', 'asc')
            ->get();
        // return $matches;
        return view('frontend.home', compact('matches'));       
    }

    public function history(Request $request)
    {
        $startDate = $request->startDate ?? now()->format('Y-m-d') ;
        $endDate = $request->endDate ?? now()->format('Y-m-d');
        $user_id = Auth()->user()->id;

        $thwin_ngwe = WalletHistory::select('user_id', DB::raw('SUM(amount) as total'))->groupBy('user_id')->where('user_id', $user_id)->where('is_deposit', 'deposit')->whereBetween('date', [ $startDate , $endDate])->first();
        $htote_ngwe = WalletHistory::select('user_id', DB::raw('SUM(amount) as total'))->groupBy('user_id')->where('user_id', $user_id)->where('is_deposit', 'withdraw')->whereBetween('date', [ $startDate , $endDate])->first();
        $bet_amount = WalletHistory::select('user_id', DB::raw('SUM(amount) as total'))->groupBy('user_id')->where('user_id', $user_id)->where('is_deposit', 'bet')->whereBetween('date', [ $startDate , $endDate])->first();
        $win_amount = WalletHistory::select('user_id', DB::raw('SUM(amount) as total'))->groupBy('user_id')->where('user_id', $user_id)->where('is_deposit', 'win')->whereBetween('date', [ $startDate , $endDate])->first();
        // $win_amount = Bet::select('user_id', DB::raw('SUM(win_amount) as total'))->groupBy('user_id')->where('user_id', $user_id)->where('bet_result', 'win')->whereBetween('date', [$startDate.' 00:00:00',$endDate.' 23:59:00'])->first();
        $lat_kyan = Wallet::where('user_id', $user_id)->first()->amount;
        return view('frontend.history', compact('thwin_ngwe', 'htote_ngwe', 'bet_amount', 'win_amount', 'lat_kyan'));
    }

    public function thwinNgwe($id, $startDate, $endDate)
    {
        $thwin_ngwe_detail = WalletHistory::where('user_id', $id)->where('is_deposit', 'deposit')->whereBetween('date', [$startDate,$endDate])->get();
        // dd($thwin_ngwe_detail);
        return view('frontend.thwin_ngwe_history_detail', compact('thwin_ngwe_detail'));
    }

    public function htoteNgwe($id, $startDate, $endDate)
    {
        $htote_ngwe_detail = WalletHistory::where('user_id', $id)->where('is_deposit', 'withdraw')->whereBetween('date', [$startDate,$endDate])->get();
        // dd($htote_ngwe_detail);
        return view('frontend.htote_ngwe_history_detail', compact('htote_ngwe_detail'));
    }

    public function pyanYaNgwe($id, $startDate, $endDate)
    {
        $bets = Bet::with('moungs')->where('user_id', $id)
            ->orderBy('date', 'asc')
            ->where('bet_result', 'win')
            ->whereBetween('date', [$startDate.' 00:00:00',$endDate.' 23:59:00'])
            ->get();
        // dd($bets);
        $htote_ngwe_detail = WalletHistory::where('user_id', $id)->where('is_deposit', 0)->whereBetween('date', [$startDate,$endDate])->get();
        return view('frontend.laung_pyan_ngwe_history_detail', compact('htote_ngwe_detail', 'bets'));
    }

    public function laungNgwe($id, $startDate, $endDate)
    {
        $bets = Bet::with('moungs')->where('user_id', $id)
            ->orderBy('date', 'asc')
            ->whereBetween('date', [$startDate.' 00:00:00',$endDate.' 23:59:00'])
            ->get();
        $htote_ngwe_detail = WalletHistory::where('user_id', $id)->where('is_deposit', 0)->whereBetween('date', [$startDate,$endDate])->get();
        return view('frontend.laung_pyan_ngwe_history_detail', compact('htote_ngwe_detail', 'bets'));
    }
}
