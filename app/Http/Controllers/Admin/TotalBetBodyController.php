<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bet;
use App\Models\Fixture;
use Illuminate\Http\Request;
use App\Helper\PermissionChecker;
use App\Http\Controllers\Controller;

class TotalBetBodyController extends Controller
{
    protected $rView = 'backend.totalbet_body.';

    public function index(Request $request){
        
        PermissionChecker::CheckPermission('total_body');
        $date = $request->date ?? now()->format('Y-m-d');
        
       
        $bet_bodys =Fixture::join('odds','fixtures.id','=','odds.match_id')
                    ->whereDate('date',$date)
                    ->get();
        //return $bet_bodys;
        
        return view($this->rView.'index',\compact('bet_bodys'));
    }

    public function overUnderTeam($match_id,$bet_team_id){

        $bets = Bet::where('match_id',$match_id)
                ->where('bet_team_id', $bet_team_id)
                ->where('type','body')
                ->where('is_finished', 0)
                ->get();
        //dd($bets);

        return view($this->rView.'body_total_bet',compact('bets'));
    }


    public function overGoal($match_id){

        $bets = Bet::where('bet_total_goal','over')
                ->where('type','body')
                ->where('is_finished', 0)   
                ->where('match_id',$match_id)->get();
        return view($this->rView.'body_total_bet',compact('bets'));
    }

    public function underGoal($match_id){

        $bets = Bet::where('bet_total_goal','under')
                ->where('type','body')
                ->where('is_finished', 0)
                ->where('match_id',$match_id)->get();
        return view($this->rView.'body_total_bet',compact('bets'));
    }
}
