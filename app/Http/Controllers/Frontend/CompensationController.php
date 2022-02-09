<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Bet;
use App\Models\Match;
use App\Models\Moung;
use App\Models\Wallet;
use App\Helper\WalletHelper;
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
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $matches = Match::join('odds', 'matches.id', '=', 'odds.match_id')
            ->join('live_odds', 'odds.id', '=', 'live_odds.odd_id')
            ->where('live_odds.live', 1)
            ->where('matches.finished', 0)
            ->where('matches.date', '>', $now)
            ->orderBy('date', 'asc')
            ->get();

        return view($this->rView.'show-moungs', compact('matches'));
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
                        Moung::create([
                            'bet_id' => $bet->id,
                            'user_id' => $user_id,
                            'live_odd_id' => $explode_arr[1],
                            'match_id' => $explode_arr[2],
                            'over_team_id' => $explode_arr[3],
                            'under_team_id' => $explode_arr[4],
                            'bet_team_id' => $bet_team_id,
                            'bet_total_goal' => $bet_goal_total,
                            'date' => $now
                        ]);
                    }
                    // dd($moung);
                }
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
        return view($this->rView.'previous-bet', compact('bets'));
    }

    public function filterPreviousBet(Request $request)
    {
        // dd($request->all());
        $user_id = auth()->user()->id;
        $bets = Bet::with('moungs')->where('user_id', $user_id)
            ->where('is_finished', 1)
            ->whereDate('date', $request->date)
            ->get();
        return view($this->rView.'filter-previous-bet', compact('bets'));
    }

    public function showActiveBet()
    {
        $user_id = auth()->user()->id;
        $bets = Bet::with('moungs')->where('user_id', $user_id)
            ->where('is_finished', 0)
            ->get();
        return view($this->rView.'active-bet', compact('bets'));
    }
}
