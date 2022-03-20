<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bet;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Controllers\Controller;

class TotalBetMoungHistoryController extends Controller
{
    protected $rView = 'backend.total_bet_moung_history.';

    public function index(Request $request){
        PermissionChecker::CheckPermission('total_moung_history');
        return view($this->rView.'index');
    }

    public function ssd(Request $request)
    {
        $date = $request->date ?? now()->format('Y-m-d');
        $bet_moung_history = Bet::whereDate('bets.updated_at',$date)
                            ->whereNotNull('bet_result')
                            ->where('type','moung')
                            ->get();
                            
        return Datatables::of($bet_moung_history)
        ->editColumn('bet_result',function($each){
            if($each->bet_result == 'win'){
              $bet_result =   '<span class="btn btn-success btn-sm font-weight-bolder" style="width:40px">နိုင်</span>';
            }else{
                $bet_result =   '<span class="btn btn-danger btn-sm font-weight-bolder" style="width:40px">ရှုံး</span>';
            }
            return $bet_result;
        })
        ->addColumn('detail',function($each){
            return  '<a href="/admin/bets-history/total-moung/detail/'.$each->bet_id.'"><i class="fas fa-eye text-success"></i></a>';
        })
        ->rawColumns(['bet_result','detail'])
        ->make(true);
    }

    public function moungDetails($bet_id)
    {
        PermissionChecker::CheckPermission('total_moung_history');
        PermissionChecker::CheckPermission('bet');
        $bets = Bet::with('moungs')
            ->where('is_finished', 1)
            ->where('bet_id',$bet_id)
            ->get();
        return view($this->rView.'moung-details', compact('bets'));
    }
}
