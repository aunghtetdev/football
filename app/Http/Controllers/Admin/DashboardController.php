<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Helper\WalletHelper;
use App\Models\MonthlyChart;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $this_year = Carbon::now()->format('Y');
        $this_month = Carbon::now()->format('m');
        $today_date = Carbon::now()->format('Y-m-d');

        $deposit_amount = WalletHelper::amount('deposit', null);
        $withdraw_amount = WalletHelper::amount('withdraw', null);
        $today_bet_amount = WalletHelper::amount('bet', $today_date);
        $total_bet_amount = WalletHelper::amount('bet', null);

        $daily_bets = WalletHistory::select(
                DB::raw('sum(amount) as total_amount'), 
                DB::raw("DATE_FORMAT(date,'%d') as days")
            )
            ->whereYear('date', $this_year)
            ->whereMonth('date', $this_month)
            ->where('is_deposit', 'bet')
            ->orderBy('date', 'asc')
            ->groupBy('days')
            ->get();

        $monthly_bets = WalletHistory::select(
                DB::raw('sum(amount) as total_amount'), 
                DB::raw("DATE_FORMAT(date,'%M') as months")
            )
            ->whereYear('date', $this_year)
            ->where('is_deposit', 'bet')
            ->orderBy('date', 'asc')
            ->groupBy('months')
            ->get();

        $monthly_chart = MonthlyChart::where('year', $this_year)->get();

        $data[] = ['Month', 'Deposits', 'Withdraw'];
        foreach ($monthly_chart as $key => $val) {
            $data[++$key] = [$val->month, (int)$val->deposit, (int)$val->withdraw];
        }
        
        return view('backend.dashboard.index', compact('deposit_amount', 'withdraw_amount', 'today_bet_amount', 'total_bet_amount', 'data', 'daily_bets', 'monthly_bets'));
    }
}
