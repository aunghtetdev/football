@extends('frontend.layouts.app')
@section('title', 'Previous Bet')
@include('frontend.layouts.nav')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row justify-content-between">
            <span>ပွဲစဥ်ဟောင်းများ</span>
            <form action="{{ route('match.filter-previous-bet') }}" method="post" id="filter-form">
                @csrf
                <p>Date: <input type="text" autocomplete="off" id="datepicker" name="date"></p>
            </form>
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