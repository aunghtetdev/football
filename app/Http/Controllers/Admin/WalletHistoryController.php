<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WalletHistory;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WalletHistoryController extends Controller
{
    public function index()
    {
        PermissionChecker::CheckPermission('balance');
        return view('backend.history.index');
    }

    public function ssd()
    {
        $wallet_hisotry = WalletHistory::query();
        return Datatables::of($wallet_hisotry)
        ->addColumn('type', function($each) {
            if ($each->is_deposit == 'deposit' || $each->is_deposit == 'bet') {
                return '<span class="badge badge-success p-2"> '.$each->is_deposit.'</span>';
            } else {
                return '<span class="badge badge-danger p-2"> '.$each->is_deposit.'</span>';
            }
        })
        ->editColumn('user_id', function ($each) {
            return $each->user ? $each->user->username : '';
        })
        ->editColumn('amount', function ($each) {
            if ($each->is_deposit == 'deposit' || $each->is_deposit == 'bet') {
                return '<p class="text-success"> + '.$each->amount.'</p>';
            } else {
                return '<p class="text-danger"> - '.$each->amount.'</p>';
            }
        })
        ->editColumn('updated_at', function ($each) {
            return $each->updated_at->format('Y-m-d h:i:s A');
        })
        ->rawColumns(['amount','action', 'type'])
        ->make(true);
    }
}
