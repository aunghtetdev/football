@extends('backend.layouts.app')
@section('totalbet-moung','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    လောင်းထားသောပွဲများ
                </div>
                <div class="card-body">
                    <h2 class="text-center bg-dark p-1">မောင်း</h2>
                    @foreach($bets as $bet)
                    @if($bet->type == 'moung')
                    <div class="outer-bet-card">
                        @foreach($bet->moungs as $moung)
                        <div class="bet-card">
                            <div class="d-flex align-items-center">
                                <div class="col-md-3 bet-card-inner">
                                    <div class="{{ $moung->over_team_id == $moung->bet_team_id ? 'bet-bg' : 'non-bet-bg' }}">{{$moung->over_team_name}}</div>
                                    <div class="{{ $moung->bet_total_goal == "over" ? 'bet-bg' : 'non-bet-bg' }}">ဂိုးပေါ်</div>
                                </div>
                                <div class="col-md-1 bet-card-inner font-weight-bolder h3">
                                    <div>{{$moung->over_team_goal}}</div>
                                </div>
                                <div class="col-md-2 bet-card-inner font-weight-bolder h2">
                                    <div>{{ $moung->odd_moungs->body_value }}</div>
                                    <div>{{ $moung->odd_moungs->goal_total_value }}</div>
                                </div>
                                
                                <div class="col-md-1 bet-card-inner font-weight-bolder h3">
                                    <div>{{$moung->under_team_goal}}</div>
                                </div>
                                <div class="col-md-3 bet-card-inner">
                                    <div class="{{ $moung->under_team_id == $moung->bet_team_id ? 'bet-bg' : 'non-bet-bg' }}">{{$moung->under_team_name}}</div>
                                    <div class="{{ $moung->bet_total_goal == "under" ? 'bet-bg' : 'non-bet-bg' }}">ဂိုးအောက်</div>
                                </div>
                                <div class="col-md-2 bet-card-inner">
                                    <div>{{$moung->date}}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row text-center text-white">
                            <div class="col-md-4 offset-md-3">
                                <div class="bet-result-{{ $bet->id }}" style="display: none">
                                    <div><span class="bet-result-text-{{ $bet->id }}"></span></div>
                                    <div><span class="bet-result-amount-{{ $bet->id }}"></span></div>
                                </div>
                                <div id="loaderIcon_{{ $bet->id }}" class="spinner-border text-primary" style="display:none;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="mb-3 mt-1 h3 font-weight-bolder">
                                    <span>ထိုးကြေး : </span>
                                    <span> {{ $bet->bet_amount }}</span>
                                </div>
                                <form action="" id="form_{{ $bet->id }}">
                                    @csrf
                                    <input type="hidden" value="{{ $bet->id }}" name="bet_id">
                                    <div class="switch-field">
                                        <input type="radio" id="radio-one-{{ $bet->id }}" class="bet_result_{{ $bet->id }}" name="bet_result_{{ $bet->id }}" value="win" checked/>
                                        <label for="radio-one-{{ $bet->id }}">နိုင်</label>
                                        <input type="radio" id="radio-two-{{ $bet->id }}" class="bet_result_{{ $bet->id }}" name="bet_result_{{ $bet->id }}" value="lose" />
                                        <label for="radio-two-{{ $bet->id }}">ရှုံး</label>
                                    </div>
                                    <input type="number" placeholder="Eg...1000" class="win-amount" id="win-amount-{{ $bet->id }}" name="win_amount">
                                    <button type="submit" onclick="addFunction({{$bet->id}}, event);" class="btn btn-submit">လျော်မည်</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function addFunction(id, event) {
        event.preventDefault();
        $('#loaderIcon_'+id).show();
        var win_amount = $('#win-amount-'+id).val();
        var input_id = '.bet_result_'+id;
        var bet_result = $(input_id+":checked").val();
        // var url = form.attr('action'); //get submit url
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
            title: 'သေချာပါသလား?',
            text: 'အလျော်အစား',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'သေချာသည်',
            cancelButtonText: 'မသေချာပါ',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/admin/bets/bet-details/compensation",
                    data:{
                        win_amount: win_amount,
                        bet_id: id,
                        bet_result: bet_result
                    }, 
                    success: function(data){
                        $('#loaderIcon_'+id).hide();
                        $('.bet-result-'+id).show();
                        console.log(data);
                        $('.bet-result-text-'+id).text("Result : "+bet_result);
                        $('.bet-result-amount-'+id).text("Amount : "+win_amount);
                        $('#form_'+id).hide();
                    }
                });
            }else{
                $('#loaderIcon_'+id).hide();
            }
        })
        // document.getElementById('formq'+id).submit();   
    }
</script>
    
@endsection