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
                    <div class="match-content" id="match-content-{{ $match->odd_moungs_id }}">
                        {{-- <a class="fullink" href="#"></a> --}}
                        <div class="match-content-inner">
                            <span class="match-date">{{ $match->match_date }}</span>
                            <div class="mpart1">
                                <div class="right_match">
                                    <span class="right_tech">
                                        <img src="{{ asset('image/football.png') }}">
                                        @if($match->away_team_id == $match->underteam_id)
                                        <div class="fname under-team-{{$match->id}}"  data-name="{{ $match->away_team_name }}">{{ $match->away_team_name }}</div>
                                        @elseif($match->home_team_id == $match->underteam_id)
                                        <div class="fname under-team-{{$match->id}}"  data-name="{{ $match->home_team_name }}">{{ $match->home_team_name }}(H)</div>
                                        @endif
                                    </span>
                                </div>
                                <strong class="match-time">{{ $match->match_time }}</strong>
                                <div class="left_match">
                                    <span class="left_tech">
                                        <img src="{{ asset('image/football.png') }}">
                                        @if($match->home_team_id == $match->over_team_id)
                                        <div class="fname over-team-{{$match->id}}"  data-name="{{ $match->home_team_name }}">{{ $match->home_team_name }}(H)</div>
                                        @elseif($match->away_team_id == $match->over_team_id)
                                        <div class="fname over-team-{{$match->id}}"  data-name="{{ $match->away_team_name }}">{{ $match->away_team_name }}</div>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                                <div class="bet-match">
                                    <input type="hidden" value="{{$match->odd_moungs_id}}" name="odd_ids[]">
                                    <span>
                                        {{-- sending all needed id in radio value  --}}
                                        <input type="radio" id="over-team-{{ $match->odd_moungs_id }}" data-name="အပေါ်သင်း" value="{{ $match->over_team_id }}-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}-{{$match->match_date}}" name="bet[{{$match->odd_moungs_id}}]">
                                        <label for="over-team-{{ $match->odd_moungs_id }}" id="over-team" class="over-team"> အပေါ်သင်း <span class="bg-light text-dark rounded p-2 font-weight-bold">{{ $match->body_value }}</span></label>
                                    </span>
                                    <span>
                                        <input type="radio" id="under-team-{{ $match->odd_moungs_id }}" data-name="အောက်အသင်း" value="{{ $match->underteam_id }}-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}-{{$match->match_date}}" name="bet[{{$match->odd_moungs_id}}]">
                                        <label for="under-team-{{ $match->odd_moungs_id }}" id="under-team" class="under-team">အောက်အသင်း</label>
                                    </span>
                                    <span class="over">
                                        <input type="radio" id="over-goal-{{ $match->odd_moungs_id }}" data-name="ဂိုးပေါ်" value="over-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}-{{$match->match_date}}" name="bet[{{$match->odd_moungs_id}}]">
                                        <label for="over-goal-{{ $match->odd_moungs_id }}" id="over-goal">ဂိုးပေါ် ({{ $match->goal_total_value }})</label>
                                    </span>
                                    <span class="under">
                                        <input type="radio" id="under-goal-{{ $match->odd_moungs_id }}" data-name="ဂိုးအောက်" value="under-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}-{{$match->match_date}}" name="bet[{{$match->odd_moungs_id}}]">
                                        <label for="under-goal-{{ $match->odd_moungs_id }}" id="under-goal" class="under-goal">ဂိုးအောက်</label>
                                    </span>
                                    <span class="goal-total-odd bg-light text-dark rounded p-2 font-weight-bolder">{{ $match->goal_total_value }}</span>
                                    
                                </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="bet-submit">
                        <input type="number" class="bet-submit-amount" name="bet_amount" placeholder="လောင်းကြေး...">
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
        
        //bet Teams
        let bet_teams = $.map($("input:radio:checked"), function(elem, idx) {
                return $(elem).attr("id");
            });
        
        let bet_team = [];
        bet_teams.map(function(elem,index){
           bet_team += document.getElementById(elem).dataset.name + "<br>";
        })


        //bet_matches
        let bet_matches = $.map($("input:radio:checked"), function(elem, idx) {
                return $(elem).val().split('-')[1];
            });
        
       const bet = bet_matches.map( elem =>   
        {
            var getmatch_over = document.querySelector('.over-team-'+elem);
            var getmatch_under = document.querySelector('.under-team-'+elem);
            
            var over_team = getmatch_over.dataset.name;
            var under_team = getmatch_under.dataset.name;

            return `<span style="line-height: 26px;">${over_team} Vs ${under_team} <br></span>`;
        }
        );
        
        
     
        
        // conditions
        

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
        }else if(bet_amount < 500){
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
                html : `<div class="d-flex justify-content-between">
                            <p class="mb-2">
                                 ${bet.map(elem =>  elem )}
                            </p>
                            <p class="font-weight-bold">${bet_team}</p>         
                        </div>
                        <div class="d-flex justify-content-center">
                            <p><span class="font-weight-bold">လောင်းငွေ : </span>${bet_amount} Ks</p>
                        </div>`,
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
                        if(match_time > current_time && current_date > match_date)
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
