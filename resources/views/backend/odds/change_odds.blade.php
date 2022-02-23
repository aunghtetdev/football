@extends('backend.layouts.app')
@section('odds','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('admin/odds') }}"><span class="badge badge-theme p-2"><i class="fas fa-arrow-left"></i></span></a>
                    Change Odds
                </div>
                <form action="{{route('odds.save-change-odds')}}" method="POST" id="change-odds">
                    @csrf
                    <input type="hidden" name="odd_id" value="{{ $live_odds->odd_id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Body</div>
                                    <input type="text" class="form-control" value="{{ $live_odds->body_value }}" name="body_value">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Goal Total</div>
                                    <input type="text" class="form-control" value="{{ $live_odds->goal_total_value }}" name="goal_total_value">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-theme" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\OddsChange', '#change-odds'); !!}
@endsection