@extends('frontend.layouts.app')
@section('display','d-none d-md-block')

@section('content')
<div class="web-sidebar-widget">
    <div class="widget-head">
        <div class="d-flex justify-content-between">
            <h3>အကောင့် password ပြောင်းရန်</h3>
        </div>
    </div>
    <div class="widget-body">
        <form action="{{route('change_password')}}" method="POST" id="change-password">
            @csrf
            <div class="form-group">
                <label for="">Old Password</label>
                <input type="text" class="form-control" name="old_password">
            </div>

            <div class="form-group">
                <label for="">New Password</label>
                <input type="text" class="form-control" name="new_password">
            </div>
            <button type="submit" class="btn btn-light btn-sm mt-3">Confirm</button>
        </form>
    </div>
</div> 
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\ChangePassword', '#change-password'); !!}
    <script>

        $(document).ready(function(){

        })
        
    </script>
@endsection