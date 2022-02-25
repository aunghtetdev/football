@extends('frontend.layouts.app')
@section('title', 'Previous Bet')
@include('frontend.layouts.nav')

@section('display','d-none d-md-block')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row justify-content-between ml-2">
            <span style="font-size:16px;font-weight: 900 !important;">ငွေစာရင်းအသေးစိတ်</span>
        </div>
    </div>
    <div class="card-body">
        @foreach($bets as $bet)
        @if($bet->type == 'body')
        <div class="bet-card">
            <div class="row">
                <div class="col-md-3 bet-card-inner bet-card-mv1">
                    <div class="{{ $bet->over_team_id == $bet->bet_team_id ? 'bet-bg' : 'non-bet-bg' }}">{{$bet->over_team_name}}</div>
                    <div class="{{ $bet->bet_total_goal == "over" ? 'bet-bg' : 'non-bet-bg' }}">Over</div>
                </div>
                <div class="col-md-1 bet-card-inner bet-card-mv2">
                    <div>{{$bet->over_team_goal}}</div>
                </div>
                <div class="col-md-2 bet-card-inner bet-card-mv3">
                    <div>{{ $bet->live_odd->body_value }}</div>
                    <div>{{ $bet->live_odd->goal_total_value }}</div>
                </div>
                <div class="col-md-1 bet-card-inner bet-card-mv2">
                    <div>{{$bet->under_team_goal}}</div>
                </div>
                <div class="col-md-3 bet-card-inner bet-card-mv1">
                    <div class="{{ $bet->under_team_id == $bet->bet_team_id ? 'bet-bg' : 'non-bet-bg' }}">{{$bet->under_team_name}}</div>
                    <div class="{{ $bet->bet_total_goal == "under" ? 'bet-bg' : 'non-bet-bg' }}">Under</div>
                </div>
                <div class="col-md-2 bet-card-inner bet-card-mvdate">
                    <div>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bet->date)->format('d-m-Y g:i A')}}</div>
                </div>
            </div>
            <div class="row text-white">
                <div class="col-md-4 offset-md-3 bet-card-mv4">
                    <div class="compensation-card">
                        <div class="row justify-content-between"><span>BetID </span><span>{{ $bet->bet_id }}</span></div>
                        <div class="row justify-content-between"><span>လောင်းငွေ </span><span>{{ $bet->bet_amount }}</span></div>
                        <div class="row justify-content-between"><span>ပြန်ရငွေ </span><span>{{ $bet->bet_result == 'win' ? $bet->win_amount:0 }}</span></div>
                        <div class="row justify-content-between"><span>အနိုင်/အရှုံး </span><span>{{ $bet->bet_result == null ? 'pending' : $bet->bet_result }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <div class="card-body">
        @foreach($bets as $bet)
        @if($bet->type == 'moung')
        <div class="outer-bet-card">
            @foreach($bet->moungs as $moung)
            <div class="bet-card">
                <div class="row">
                    <div class="col-md-3 bet-card-inner bet-card-mv1">
                        <div class="{{ $moung->over_team_id == $moung->bet_team_id ? 'bet-bg' : 'non-bet-bg' }}">{{$moung->over_team_name}}</div>
                        <div class="{{ $moung->bet_total_goal == "over" ? 'bet-bg' : 'non-bet-bg' }}">Over</div>
                    </div>
                    <div class="col-md-1 bet-card-inner bet-card-mv2">
                        <div>{{$moung->over_team_goal}}</div>
                    </div>
                    <div class="col-md-2 bet-card-inner bet-card-mv3">
                        <div>{{ $moung->live_odd->body_value }}</div>
                        <div>{{ $moung->live_odd->goal_total_value }}</div>
                    </div>
                    <div class="col-md-1 bet-card-inner bet-card-mv2">
                        <div>{{$moung->under_team_goal}}</div>
                    </div>
                    <div class="col-md-3 bet-card-inner bet-card-mv1">
                        <div class="{{ $moung->under_team_id == $moung->bet_team_id ? 'bet-bg' : 'non-bet-bg' }}">{{$moung->under_team_name}}</div>
                        <div class="{{ $moung->bet_total_goal == "under" ? 'bet-bg' : 'non-bet-bg' }}">Under</div>
                    </div>
                    <div class="col-md-2 bet-card-inne bet-card-mvdate">
                        <div>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $moung->date)->format('d-m-Y g:i A')}}</div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row text-center text-white">
                <div class="col-md-4 offset-md-3 bet-card-mv4">
                    <div class="compensation-card">
                        <div class="row justify-content-between"><span>BetID </span><span>{{ $bet->bet_id }}</span></div>
                        <div class="row justify-content-between"><span>မောင်း </span><span>{{ $bet->moungs->count() }}</span></div>
                        <div class="row justify-content-between"><span>လောင်းငွေ </span><span>{{ $bet->bet_amount }}</span></div>
                        <div class="row justify-content-between"><span>ပြန်ရငွေ </span><span>{{ $bet->bet_result == 'win' ? $bet->win_amount:0 }}</span></div>
                        <div class="row justify-content-between"><span>အနိုင်/အရှုံး </span><span>{{ $bet->bet_result == null ? 'pending' : $bet->bet_result }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
<script>
$( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function(date) {
            $("#filter-form").submit();
            //OR $("#yourButton").click();
        }
    });
} );
</script>
@endsection