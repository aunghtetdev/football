<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bet;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Controllers\Controller;

class TotalBetBodyHistoryController extends Controller
{
    public function index(Request $request){
        PermissionChecker::CheckPermission('total_body_history');
        return view('backend.total_bet_body_history.index');
    }

    public function ssd(Request $request)
    {
        $date = $request->date ?? now()->format('Y-m-d');
        $bet_body_history = Bet::whereDate('bets.updated_at',$date)->with('live_odd')
                            ->join('fixtures','bets.match_id','=','fixtures.id')
                            ->whereNotNull('bet_result')
                            ->where('type','body')
                            ->get();
        return Datatables::of($bet_body_history)
        ->editColumn('over_team_id',function($each){

            $over_team = '<span class="font-weight-bolder">'.$each->over_team_name.'</span>';  
            $under_team = '<span class="font-weight-bolder">'.$each->under_team_name.'</span>'; 


            return  $over_team.' Vs '.$under_team ;
        })
        ->editColumn('bet_team_id',function($each){
            return $each->bet_team_id ? '<span>'.$each->bet_team_name.'</span>' : ($each->bet_total_goal == 'over' ? '<span class="font-weight-bolder">ဂိုးပေါ်</span>' : '<span class="font-weight-bolder">ဂိုးအောက်</span>') ;
        })
        ->editColumn('goal',function($each){
            $over_team_goal = 0;
            $under_team_goal = 0;

            if($each->home_team_id == $each->over_team_id){
                $over_team_goal +=  $each->home_team_goal ;
            }else{
                $under_team_goal +=  $each->home_team_goal ;
            }

            if($each->away_team_id == $each->over_team_id){
                $over_team_goal +=  $each->away_team_goal ;
            }else{
                $under_team_goal +=  $each->away_team_goal ;
            }

            return $over_team_goal.' - '.$under_team_goal;
        })
        ->editColumn('live_odd_id',function($each){
            $body_value = '<span class="btn btn-warning btn-sm font-weight-bolder">'.$each->live_odd->body_value.'</span>';
            $goal_total_value = '<span class="btn btn-info btn-sm font-weight-bolder">'.$each->live_odd->goal_total_value.'</span>';
            return  $body_value .' '. $goal_total_value;
        })
        ->editColumn('bet_result',function($each){
            if($each->bet_result == 'win'){
              $bet_result =   '<span class="btn btn-success btn-sm font-weight-bolder" style="width:40px">နိုင်</span>';
            }else{
            $bet_result =   '<span class="btn btn-danger btn-sm font-weight-bolder" style="width:40px">ရှုံး</span>';
            }

            return $bet_result;
        })
        ->rawColumns(['over_team_id','bet_team_id','live_odd_id','bet_result'])
        ->make(true);
    }
}
