<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $matches = Match::join('odds', 'matches.id', '=', 'odds.match_id')
            ->join('live_odds', 'odds.id', '=', 'live_odds.odd_id')
            ->where('live_odds.live', 1)
            ->where('matches.finished', 0)
            ->where('matches.date', '>', $now)
            ->orderBy('date', 'asc')
            ->get();
        // return $matches;
        return view('frontend.home', compact('matches'));
    }
}
