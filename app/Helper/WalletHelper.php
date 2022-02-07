<?php

namespace App\Helper;

use Carbon\Carbon;
use App\Models\MonthlyChart;
use App\Helper\UUIDGenerator;
use App\Models\WalletHistory;
use Illuminate\Support\Facades\DB;

class WalletHelper
{
    public static function storeHistory($user_id, $amount, $type)
    {
        $history = new WalletHistory();
        $history->user_id = $user_id;
        $history->trx_id = UUIDGenerator::Trx_id();
        $history->amount = $amount;
        $history->is_deposit = $type;
        $history->date = Carbon::now()->format('Y-m-d');
        $history->save();
    }

    public static function monthly_history($year, $type)
    {
        $data = WalletHistory::select(
                DB::raw('sum(amount) as '.$type),
                DB::raw("DATE_FORMAT(date, '%M') as months")
            )
            ->whereYear('date', Carbon::now()->format('Y'))
            ->where('is_deposit', $type)
            ->orderBy('date', 'asc')
            ->groupBy('months')
            ->get();
        return $data;
    }

    public static function amount($type, $date)
    {
        if($date != null)
        {
            $data = WalletHistory::select(DB::raw('sum(amount) as total_amount'))
                ->where('date', $date)
                ->where('is_deposit', $type)
                ->pluck('total_amount')
                ->first();
        }else{
            $data = WalletHistory::select(DB::raw('sum(amount) as total_amount'))
                ->where('is_deposit', $type)
                ->pluck('total_amount')
                ->first();
        }
        return $data;
    }

    public static function monthly_chart($amount, $type)
    {
        $month = Carbon::now()->format('M');
        $year = Carbon::now()->format('Y');
        $exist = MonthlyChart::where('year', $year)->where('month', $month)->first();
        if($exist)
        {
            $exist->$type += $amount;
            $exist->save();
        }else{
            MonthlyChart::create([
                'month' => $month,
                'year' => $year,
                $type => $amount
            ]);
        }
        
    }
}
