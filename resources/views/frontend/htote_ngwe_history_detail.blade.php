@extends('frontend.layouts.app')
@section('content')
<div class="web-sidebar-widget">
    <div class="widget-head">
        <div class="d-flex justify-content-between">
            <h3>ငွေစာရင်းအသေးစိတ်</h3>
        </div>
    </div>
    <div class="widget-body">
        <div class="d-flex justify-content-between align-items-center">
            <p><strong>ရက်စွဲ</strong></p>
            <p><strong>အကြောင်းအရာ</strong></p>
            <p><strong>ငွေပမာဏ</strong></p>
        </div>
        @foreach($htote_ngwe_detail ?? [] as $detail)
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-1"><strong>{{$detail->updated_at->format('d-m-Y')}}</strong></p>
                <p><strong>{{$detail->updated_at->format('h:i:s A')}}</strong></p>
            </div>
            <p style="padding-right : 52px"><strong>To Agent</strong></p>
            <p style="padding-right : 17px"><strong>{{$detail->balance}}</strong></p>
        </div>
        @endforeach
    </div>
</div> 
@endsection
@section('scripts')
    <script>
        
    </script>
@endsection