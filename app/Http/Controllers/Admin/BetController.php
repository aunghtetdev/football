<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bet;
use App\Models\Wallet;
use App\Helper\WalletHelper;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BetController extends Controller
{
    protected $model;

    protected $rView = 'backend.bets.';

    public function __construct(Bet $model)
    {
        return $this->model = $model;
    }

    public function index()
    {
        PermissionChecker::CheckPermission('bet');
        return view($this->rView.'index');
    }

    public function ssd()
    {
        $users = DB::table('users')
            ->join('bets', 'users.id', '=', 'bets.user_id')
            ->selectRaw('users.id, username, count(bets.bet_id) as total_bet_count, sum(bets.bet_amount) as total_bet_amount')
            ->groupBy('username', 'users.id')
            ->where('bets.is_finished', 0)
            ->get();
        return Datatables::of($users)
        ->addColumn('action', function ($each) {
            $detail_icon = '<a href="'.url('admin/bets/bet-details/'.$each->id).'" class="btn btn-primary">Details</a>';
            return '<div class="action-icon">'. $detail_icon .'</div>';
        })
        ->make(true);
    }

    public function betDetails($user_id)
    {
        PermissionChecker::CheckPermission('bet');
        $bets = Bet::with('moungs')->where('user_id', $user_id)
            ->where('is_finished', 0)
            ->get();
        return view($this->rView.'bet-details', compact('bets'));
    }
    public function saveCompensation(Request $request)
    {
        DB::beginTransaction();

        try {
            $bet = $this->model->findOrFail($request->bet_id);
            $bet->win_amount = $request->win_amount;
            $bet->bet_result = $request->bet_result;
            $bet->is_finished = 1;
            $bet->save();

            $compensation = Wallet::where('user_id', $bet->user_id)->first();
            $compensation->increment('amount', $bet->win_amount+$bet->bet_amount);
            $compensation->save();

            if($bet->bet_result == 'win')
            {
                WalletHelper::storeHistory($bet->user_id, $bet->win_amount, 'win');
            }

            DB::commit();
            return response()->json($bet);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e);
        }
    }
}
