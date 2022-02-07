<?php

namespace App\Http\Controllers;

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
        return view('frontend.home');
    }

    public function history(Request $request)
    {
        $startDate = $request->startDate ?? now()->format('Y-m-d') ;
        $endDate = $request->endDate ?? now()->format('Y-m-d');
        
        $thwin_ngwe = WalletHistory::select('user_id', DB::raw('SUM(balance) as total'))->groupBy('user_id')->where('user_id', Auth()->user()->id)->where('is_deposit', 1)->whereBetween('date', [ $startDate , $endDate])->first();
        $htote_ngwe = WalletHistory::select('user_id', DB::raw('SUM(balance) as total'))->groupBy('user_id')->where('user_id', Auth()->user()->id)->where('is_deposit', 0)->whereBetween('date', [ $startDate , $endDate])->first();
        return view('frontend.history', compact('thwin_ngwe', 'htote_ngwe'));
    }

    public function thwinNgwe($id, $startDate, $endDate)
    {
        $thwin_ngwe_detail = WalletHistory::where('user_id', $id)->where('is_deposit', 1)->whereBetween('date', [$startDate,$endDate])->get();
        
        return view('frontend.thwin_ngwe_history_detail', compact('thwin_ngwe_detail'));
    }

    public function htoteNgwe($id, $startDate, $endDate)
    {
        $htote_ngwe_detail = WalletHistory::where('user_id', $id)->where('is_deposit', 0)->whereBetween('date', [$startDate,$endDate])->get();
        return view('frontend.htote_ngwe_history_detail', compact('htote_ngwe_detail'));
    }

    public function laungPyanNgwe($id, $startDate, $endDate)
    {
        $htote_ngwe_detail = WalletHistory::where('user_id', $id)->where('is_deposit', 0)->whereBetween('date', [$startDate,$endDate])->get();
        return view('frontend.laung_pyan_ngwe_history_detail', compact('htote_ngwe_detail'));
    }
}
