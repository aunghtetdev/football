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
        PermissionChecker::CheckPermission('view_balance_history');
        return view('backend.history.index');
    }

    public function ssd()
    {
        $wallet_hisotry = WalletHistory::query();
        return Datatables::of($wallet_hisotry)
        ->editColumn('user_id', function ($each) {
            return $each->user ? $each->user->username : '';
        })
        ->editColumn('balance', function ($each) {
            if ($each->is_deposit) {
                return '<p class="text-success"> + '.$each->balance.'</p>';
            } else {
                return '<p class="text-danger"> - '.$each->balance.'</p>';
            }
        })
        ->editColumn('updated_at', function ($each) {
            return $each->updated_at->format('Y-m-d h:i:s A');
        })
        ->rawColumns(['balance','action'])
        ->make(true);
    }
}
