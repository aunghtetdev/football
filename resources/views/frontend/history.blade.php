@extends('frontend.layouts.app')
@section('content')
<div class="web-sidebar-widget">
    <div class="widget-head">
        <div class="d-flex justify-content-between">
            <h3>ငွေစာရင်း</h3>
            <div id="date_input">
                <i class="fas fa-sort-amount-down-alt" id="date"  style="cursor: pointer; padding : 5px;"></i>
                <input type="hidden" class="date" >
            </div>
            
        </div>
    </div>
    <div class="widget-body">
        <p style="padding : 15px ; background : var(--secondary); border-radius :5px; text-align:center;">
        <span>
            @if(request()->startDate == request()->endDate)
            {{request()->startDate ?? now()->format('Y-m-d')}}
            @else
            {{request()->startDate .' မှ '.request()->endDate . ' ထိ' ?? now()->format('Y-m-d')}}
            @endif
        </span>
        </p>
        
        <p><a href="{{url('history/thwin_ngwe/'.Auth()->user()->id.'/'.(request()->startDate ? request()->startDate : now()->format('Y-m-d')).'/'.(request()->endDate ? request()->endDate : now()->format('Y-m-d'))) }}"><strong>သွင်းငွေ -</strong> {{$thwin_ngwe ? $thwin_ngwe->total : 0 }} ks</a></p>
        <p><a href="{{url('history/pyan_ya_ngwe/'.Auth()->user()->id.'/'.(request()->startDate ? request()->startDate : now()->format('Y-m-d')).'/'.(request()->endDate ? request()->endDate : now()->format('Y-m-d'))) }}"><strong>ပြန်ရငွေ -</strong>{{$win_amount ? $win_amount->total : 0 }} ks</a></p>
        <p><a href="{{url('history/laung_ngwe/'.Auth()->user()->id.'/'.(request()->startDate ? request()->startDate : now()->format('Y-m-d')).'/'.(request()->endDate ? request()->endDate : now()->format('Y-m-d'))) }}"><strong>လောင်းငွေ -</strong>{{$bet_amount ? $bet_amount->total : 0 }} ks</a></p>
        <p><a href="{{url('history/htote_ngwe/'.Auth()->user()->id.'/'.(request()->startDate ? request()->startDate : now()->format('Y-m-d')).'/'.(request()->endDate ? request()->endDate : now()->format('Y-m-d')))}}"><strong>ထုတ်ငွေ -</strong> {{$htote_ngwe ? $htote_ngwe->total : 0 }} ks</a></p>
        <p><strong>လက်ကျန် -</strong> {{$lat_kyan}} ks</p>
    </div>
</div> 
@endsection
@section('scripts')
    <script>

        $(document).ready(function(){
            $(function() {

                var start = moment();
                var end = moment();

                $('#date_input').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    }
                    
                });
                
                $('#date_input').on('apply.daterangepicker', function(ev, picker) {
                    let startDate = picker.startDate.format('YYYY-MM-DD');
                    let endDate = picker.endDate.format('YYYY-MM-DD');
                    
                    history.pushState(null, '' , `?startDate=${startDate}&endDate=${endDate}`);
                    window.location.reload();
                });

                
            });
            

        })
        
    </script>
@endsection