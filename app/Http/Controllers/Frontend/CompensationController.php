<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ad;
use Carbon\Carbon;
use App\Models\Bet;
use App\Models\Moung;
use App\Models\Wallet;
use App\Models\Fixture;
use App\Helper\WalletHelper;
use App\Models\FixtureMoung;
use Illuminate\Http\Request;
use App\Helper\UUIDGenerator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CompensationController extends Controller
{
    protected $model;

    protected $rView = 'frontend.bets.';

    public function __construct(Bet $model)
    {
        return $this->model = $model;
    }

    public function betMatch(Request $request)

    {
        //return $request->all();
        DB::beginTransaction();
        try {
            //index 0 for bet_team_id or over and under...,index 1 for live_odd_id,
            //index 2 for match_id,index 3 for over_team_id,index 4 for under_team_id
            $explode_arr = explode('-', $request->bet);
            $bet_side = $explode_arr[0];
            $bet_goal_total = '';
            $bet_team_id = null;
            $user_id = auth()->user()->id;
            //checking user bet is team or total goal
            if ($bet_side == 'over' || $bet_side == 'under') {
                $bet_goal_total = $bet_side;
            } else {
                $bet_team_id = $bet_side;
            }


            $this->model->create([
                'bet_id' => UUIDGenerator::BetID(),
                'user_id' => $user_id,
                'live_odd_id' => $explode_arr[1],
                'match_id' => $explode_arr[2],
                'over_team_id' => $explode_arr[3],
                'under_team_id' => $explode_arr[4],
                'bet_team_id' => $bet_team_id,
                'bet_total_goal' => $bet_goal_total,
                'bet_amount' => $request->bet_amount,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'type' => 'body'
            ]);

            $fixture = Fixture::findorFail($explode_arr[2]);
            
            if ($bet_side == 'over'){
                $fixture->over_goal_amount += $request->bet_amount;

            }

            if ($bet_side == 'under'){
                $fixture->under_goal_amount += $request->bet_amount;

            }

            if($bet_team_id == $explode_arr[3]){
                $fixture->overteam_amount += $request->bet_amount;

            }

            if($bet_team_id == $explode_arr[4]){
                $fixture->underteam_amount += $request->bet_amount;

            }

            $fixture->save();
            
            $wallet = Wallet::where('user_id', $user_id)->first();
            $wallet->amount -= $request->bet_amount;
            $wallet->save();

            WalletHelper::storeHistory($user_id, $request->bet_amount, 'bet');

            DB::commit();
            return redirect('/home')->with('bet', 'အောင်မြင်စွာလောင်းပြီးပါပြီ။');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/home')->with('bet-error', 'တခုခုချို့ယွင်းနေပါသည်။ ပြန်လည်ကြိုးစားပေးပါ။');
        }
    }
    
    public function showMoung()
    {
        $now = Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s');
        $matches = FixtureMoung::join('odd_moungs', 'fixture_moungs.id', '=', 'odd_moungs.match_id')
            ->select('*', 'odd_moungs.id as odd_moungs_id')
            ->where('fixture_moungs.finished', 0)
            ->where('fixture_moungs.date', '>', $now)
            ->orderBy('date', 'asc')
            ->get();
        // dd($matches);
            $ads = Ad::latest()->first();
        return view($this->rView.'show-moungs', compact('matches','ads'));
    }

    public function betMoung(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id = auth()->user()->id;
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $bet = $this->model->create([
                'bet_id' => UUIDGenerator::BetID(),
                'user_id' => $user_id,
                'bet_amount' => $request->bet_amount,
                'date' => $now,
                'type' => 'moung'
            ]);
            //looping matches odds and filter with bet odds
            foreach ($request->odd_ids as $odd_id) {
                foreach ($request->bet as $key => $value) {
                    if ($odd_id == $key) {
                        $explode_arr = explode('-', $value);
                        $bet_side = $explode_arr[0];
                        $bet_goal_total = '';
                        $bet_team_id = null;
                        //checking user bet is team or total goal
                        if ($bet_side == 'over' || $bet_side == 'under') {
                            $bet_goal_total = $bet_side;
                        } else {
                            $bet_team_id = $bet_side;
                        }
                        // dd($bet->id);
                        //insert moungs with loop which bet from user
                        
                       $moung =  Moung::create([
                            'bet_id' => $bet->id,
                            'user_id' => $user_id,
                            'odd_moung_id' => $explode_arr[1],
                            'match_id' => $explode_arr[2],
                            'over_team_id' => $explode_arr[3],
                            'under_team_id' => $explode_arr[4],
                            'bet_team_id' => $bet_team_id,
                            'bet_total_goal' => $bet_goal_total,
                            'date' => $now,
                        ]);
                    }

            $fixture = FixtureMoung::findorFail($explode_arr[2]);
            
            if ($bet_side == 'over'){
                $fixture->over_goal_amount += $request->bet_amount;

            }

            if ($bet_side == 'under'){
                $fixture->under_goal_amount += $request->bet_amount;

            }

            if($bet_team_id == $explode_arr[3]){
                $fixture->overteam_amount += $request->bet_amount;

            }

            if($bet_team_id == $explode_arr[4]){
                $fixture->underteam_amount += $request->bet_amount;

            }
            // dd($moung);
        }
        $fixture->save();
            }
            $wallet = Wallet::where('user_id', $user_id)->first();
            $wallet->amount -= $request->bet_amount;
            $wallet->save();

            WalletHelper::storeHistory($user_id, $request->bet_amount, 'bet');

            DB::commit();
            return redirect('/match/moung')->with('bet', 'အောင်မြင်စွာလောင်းပြီးပါပြီ။');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/match/moung')->with('bet-error', 'တခုခုချို့ယွင်းနေပါသည်။ ပြန်လည်ကြိုးစားပေးပါ။');
        }
    }

    public function showBody()
    {
        $now = Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s');
        $matches = Fixture::join('odds', 'fixtures.id', '=', 'odds.match_id')
            ->join('live_odds', 'odds.id', '=', 'live_odds.odd_id')
            ->where('live_odds.live', 1)
            ->where('fixtures.finished', 0)
            ->where('fixtures.date', '>', $now)
            ->orderBy('date', 'asc')
            ->get();
        //return $matches;
        $ads = Ad::latest()->first();
        return view('frontend.bets.show-body', compact('matches','ads'));
    }

    public function showPreviousBet()
    {
        $user_id = auth()->user()->id;
        $last_date = Bet::orderBy('date', 'desc')
            ->where('user_id', $user_id)
            ->where('is_finished', 1)
            ->pluck('date')
            ->first();
        $bets = Bet::with('moungs')->where('user_id', $user_id)
            ->where('is_finished', 1)
            ->whereDate('date', $last_date)
            ->get();

            $ads = Ad::latest()->first();
        
        return view($this->rView.'previous-bet', compact('bets','ads'));
    }

    public function filterPreviousBet(Request $request)
    {
        // dd($request->all());
        $user_id = auth()->user()->id;
        $bets = Bet::with('moungs')->where('user_id', $user_id)
            ->where('is_finished', 1)
            ->whereDate('date', $request->date)
            ->get();
            //dd($bets);
            $ads = Ad::latest()->first();
        return view($this->rView.'filter-previous-bet', compact('bets','ads'));
    }

    public function showActiveBet()
    {
        $user_id = auth()->user()->id;
        $bets = Bet::with('moungs')->where('user_id', $user_id)
            ->where('is_finished', 0)
            ->get();
        
            $ads = Ad::latest()->first();
        return view($this->rView.'active-bet', compact('bets','ads'));
    }
}
