@extends('frontend.layouts.app')
@section('title', 'Previous Bet')
@include('frontend.layouts.nav')

@section('display','d-none d-md-block')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-3 col-md-6 col-lg-8">
                <span class="mb-1" style="font-weight: 900 ">ပွဲစဥ်ဟောင်းများ</span>
            </div>
            <div class="col-9 col-md-6 col-lg-4 ">
                <form action="{{ route('match.filter-previous-bet') }}" method="post" id="filter-form" class="mb-0">
                    @csrf
                    <p class="mb-1">Date: <input type="text" autocomplete="off" id="datepicker" name="date" >
                    </p>  
                </form>
            </div>
        </div>
    </div>
    
    @include('frontend.bets.bet-card')
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