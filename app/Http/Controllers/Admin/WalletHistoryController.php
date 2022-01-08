<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WalletHistory;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletHistoryController extends Controller
{
    public function index()
    {
        if (Auth()->user()->can('view_balance_history')) {
            return view('backend.history.index');
        } else {
            return abort(404);
        }
    }

    public function ssd()
    {
        $wallet_hisotry = WalletHistory::query();
        return Datatables::of($wallet_hisotry)
        ->editColumn('user_id', function ($each) {
            return $each->user ? $each->user->username : '';
        })
        ->editColumn('amount', function ($each) {
            if ($each->is_deposit) {
                return '<p class="text-success"> + '.$each->amount.'</p>';
            } else {
                return '<p class="text-danger"> - '.$each->amount.'</p>';
            }
        })
        ->editColumn('updated_at', function ($each) {
            return $each->updated_at->format('Y-m-d h:i:s A');
        })
        ->rawColumns(['amount','action'])
        ->make(true);
    }
}
