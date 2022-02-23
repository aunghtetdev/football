@extends('frontend.layouts.app')
@include('frontend.layouts.nav')

@section('display','d-none d-md-block')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <span class=" pl-3" style="font-weight: 900">လောင်းထားသောပွဲများ</span>
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