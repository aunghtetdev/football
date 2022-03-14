<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bet;
use App\Models\Moung;
use App\Models\Fixture;
use App\Models\OddMoung;
use App\Models\FixtureMoung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TotalBetMoungController extends Controller
{
    protected $rView = 'backend.totalbet_moung.';

    public function index(Request $request){
        
        $date = $request->date ?? now()->format('Y-m-d');
        
       
        $bet_moungs =FixtureMoung::join('odd_moungs','fixture_moungs.id','=','odd_moungs.match_id')
                    ->whereDate('date',$date)
                    ->get();
        //return $bet_bodys;
        
        return view($this->rView.'index',\compact('bet_moungs'));
    }

    public function betting(){

        $bets = Bet::with(['moungs'])
                ->where('bets.type','moung')
                ->where('is_finished',0)
                ->get();
        
        return view($this->rView.'betting',compact('bets'));
    }
}
