@extends('frontend.layouts.app')
@section('title', 'Home')
@include('frontend.layouts.nav')

@section('content')

<section class="main-content">
    <div class="main-content-img">
        <img alt="" src="https://www.footyrenders.com/render/kylian-mbappe-48.png">
    </div> 
    <h2 class="main-content-title">ဘောပွဲလောင်းမယ်</h2> 
    <p class="main-content-text">
        Promotion များကိုဒီနေရာတွင် ကြေညာနိုင်သည်။
    </p> 
</section>
<section>
    <div class="game-box">
        <div class="card">
            <div class="card-body">
                <div class="match_today container" id="match_today">
                    <form action="{{ route('match.bet-match') }}" id="bet-form" method="POST">
                    @csrf
                    <h3>ဘော်ဒီပွဲစဥ်များ</h3>
                    <!--matches-->
                    @foreach($matches as $match)
                    <div class="match-content" id="match-content-{{ $match->odd_id }}">
                        {{-- <a class="fullink" href="#"></a> --}}
                        <div class="match-content-inner">
                            <span class="match-date">06 Feb</span>
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
                                <span>
                                    <input type="radio" id="over-team-{{ $match->odd_id }}" value="{{ $match->over_team_id }}-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}" name="bet">
                                    <label for="over-team-{{ $match->odd_id }}" class="over-team"> အပေါ်ကြေးအသင်း ({{ $match->body_value }})</label>
                                </span>
                                <span>
                                    <input type="radio" id="under-team-{{ $match->odd_id }}" value="{{ $match->underteam_id }}-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}" name="bet">
                                    <label for="under-team-{{ $match->odd_id }}" class="under-team">အောက်ကြေးအသင်း</label>
                                </span>
                                <span class="over">
                                    <input type="radio" id="over-goal-{{ $match->odd_id }}" value="over-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}" name="bet">
                                    <label for="over-goal-{{ $match->odd_id }}">ဂိုးပေါ် ({{ $match->goal_total_value }})</label>
                                </span>
                                <span class="under">
                                    <input type="radio" id="under-goal-{{ $match->odd_id }}" value="under-{{$match->id}}-{{$match->match_id}}-{{$match->over_team_id}}-{{$match->underteam_id}}-{{$match->match_time}}" name="bet">
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
        var bet = $("input[name=bet]:checked").val();
        var bet_amount = $("input[name=bet_amount]").val();
        var amount = {!! json_encode((array)auth()->user()->wallet->amount) !!};
        console.log(amount)
        if(!bet)
        {
            Toast.fire({
                icon: 'info',
                title: 'လောင်းမည့်အသင်းရွေးပေးပါ။'
            })
        }else if(bet_amount < 1000){
            Toast.fire({
                icon: 'info',
                title: 'အနည်းဆုံး ၁၀၀၀ကျပ် လောင်းပါ။'
            })
        }else if(amount < bet_amount){
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
                    var match_time = bet.split('-')[5];
                    var current_time = formatAMPM(new Date);
                    console.log(current_time)
                    if(match_time < current_time)
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
    function formatAMPM(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }
</script>
@endsection
