@extends('frontend.layouts.app')
@section('title', 'Moung')
@include('frontend.layouts.nav')

@section('display','d-none d-md-block')

@section('content')

<section>
    <div class="game-box">
        <div class="card">
            <div class="card-body">
                <div class="match_today container" id="match_today">
                    <form action="{{ route('match.bet-moung') }}" id="bet-form" method="POST">
                        @csrf
                        <h3 class="mb-2">မောင်းပွဲစဥ်များ</h3>
                    @foreach($matches as $match)
                    <!--matches-->
                    <div class="match-content" id="match-content-{{ $match->odd_id }}">
                        {{-- <a class="fullink" href="#"></a> --}}
                        <div class="match-content-inner">
                            <span class="match-date">{{ $match->match_date }}</span>
                            <div class="mpart1">
                                <div class="right_match">
                                    <span class="right_tech">
                                        <img src="{{ asset('image/football.png') }}">
                                        @if($match->away_team_id == $match->underteam_id)
                                        <div class="fname">{{ $match->away_team_name }}</div>
                                        @elseif($match->home_team_id == $match->underteam_id)
                                        <div class="fname">{{ $match->home_team_name }}(H)</div>
                                        @endif
                                    </span>
                                </div>
                                <strong class="match-time">{{ $match->match_time }}</strong>
                                <div class="left_match">
                                    <span class="left_tech">
                                        <img src="{{ asset('image/football.png') }}">
                                        @if($match->home_team_id == $match->over_team_id)
                                        <div class="fname">{{ $match->home_team_name }}(H)</div>
                                        @elseif($match->away_team_id == $match->over_team_id)
                                        <div class="fname">{{ $match->away_team_name }}</div>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                                <div class="bet-match">
                                    <input type="hidden" value="{{$match->odd_id}}" name="odd_ids[]">
                                    <span>
                                        {{-- sending all needed id in radio value  --}}
                                        <input type="radio" id="over-team-{{ $match->odd_id }}" value="{{ $match->over_team_id }}-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}-{{$match->match_date}}" name="bet[{{$match->odd_id}}]">
                                        <label for="over-team-{{ $match->odd_id }}" id="over-team" class="over-team"> အပေါ်ကြေးအသင်း ({{ $match->body_value }})</label>
                                    </span>
                                    <span>
                                        <input type="radio" id="under-team-{{ $match->odd_id }}" value="{{ $match->underteam_id }}-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}-{{$match->match_date}}" name="bet[{{$match->odd_id}}]">
                                        <label for="under-team-{{ $match->odd_id }}" class="under-team">အောက်ကြေးအသင်း</label>
                                    </span>
                                    <span class="over">
                                        <input type="radio" id="over-goal-{{ $match->odd_id }}" value="over-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}-{{$match->match_date}}" name="bet[{{$match->odd_id}}]">
                                        <label for="over-goal-{{ $match->odd_id }}">ဂိုးပေါ် ({{ $match->goal_total_value }})</label>
                                    </span>
                                    <span class="under">
                                        <input type="radio" id="under-goal-{{ $match->odd_id }}" value="under-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}-{{$match->match_date}}" name="bet[{{$match->odd_id}}]">
                                        <label for="under-goal-{{ $match->odd_id }}" class="under-goal">ဂိုးအောက်</label>
                                    </span>
                                    
                                </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="bet-submit">
                        <input type="text" class="bet-submit-amount" name="bet_amount" placeholder="လောင်းကြေး...">
                        <input type="submit" onclick="betSubmit(event)" value="Bet" class="btn btn-primary bet-submit-btn">
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //Submit Bet with confirm box
    function betSubmit(event) {
        event.preventDefault();
        var bet_amount = $("input[name=bet_amount]").val();
        var amount = {!! json_encode((array)auth()->user()->wallet->amount) !!};
        var bets = $.map($("input:radio:checked"), function(elem, idx) {
                return $(elem).attr("name") + "=" + $(elem).val();
            });
        if(bets.length == 0)
        {
            Toast.fire({
                icon: 'info',
                title: 'လောင်းမည့်အသင်းရွေးပေးပါ။'
            })
        }else if(bets.length < 2){
            Toast.fire({
                icon: 'info',
                title: 'အနည်းဆုံး ၂ပွဲနင့်အထက် လောင်းပါ။'
            })
        }else if(parseInt(bet_amount) < 500){
            Toast.fire({
                icon: 'info',
                title: 'အနည်းဆုံး ၅၀၀ကျပ် လောင်းပါ။'
            })
        }else if(parseInt(amount[0]) < parseInt(bet_amount)){
            console.log(parseInt(amount[0]) < parseInt(bet_amount))
            Toast.fire({
                icon: 'info',
                title: 'လက်ကျန်ငွေမလုံလောက်ပါ။'
            })
        }else{
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-1',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                title: 'လောင်းမည်',
                text: 'လောင်းမည်သေချာပါသလား!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'သေချာသည်',
                cancelButtonText: 'မသေချာပါ',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    var over_time = false;
                    $.each(bets, function(i, bet) {
                        var split_bet = bet.split('=')[1];
                        var match_time = split_bet.split('-')[5];
                        var match_date = bet.split('-')[6];
                        var current_date = todayDateFormat();
                        console.log(match_time)
                        var current_time = formatAMPM(new Date);
                        if(match_time < current_time && current_date < match_date)
                        {
                            over_time = true;
                        }
                    });
                    if(over_time)
                    {
                        Toast.fire({
                        icon: 'error',
                        title: 'ပွဲစသွားပါပြီ။'
                        })
                        location.reload();
                    }else{
                        document.getElementById('bet-form').submit();
                    }
                }
            })
        }
    
    }
    function todayDateFormat()
    {
        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                            ];
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = monthNames[today.getMonth()]; //January is 0!

        today = dd + ' ' + mm;
        return today;
    }
    function formatAMPM(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes() - 5;
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }
</script>
@endsection
