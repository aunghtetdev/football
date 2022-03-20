<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bet;
use App\Models\Moung;
use App\Models\Fixture;
use App\Models\OddMoung;
use App\Models\FixtureMoung;
use Illuminate\Http\Request;
use App\Helper\PermissionChecker;
use App\Http\Controllers\Controller;

class TotalBetMoungController extends Controller
{
    protected $rView = 'backend.totalbet_moung.';

    public function index(Request $request){
        
        PermissionChecker::CheckPermission('total_moung');

        $date = $request->date ?? now()->format('Y-m-d');
        
        $bet_moungs =FixtureMoung::join('odd_moungs','fixture_moungs.id','=','odd_moungs.match_id')
                    ->whereDate('date',$date)
                    ->get();
        //return $bet_bodys;
        //dd($bet_moung_history);
        return view($this->rView.'index',\compact('bet_moungs'));
    }

    public function betting(){

        PermissionChecker::CheckPermission('total_moung');
        $bets = Bet::with(['moungs'])
                ->where('bets.type','moung')
                ->whereNull('bet_result')
                ->get();
        
        return view($this->rView.'betting',compact('bets'));
    }
}
