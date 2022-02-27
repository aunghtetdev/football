@extends('backend.layouts.app')
@section('odds','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('admin/odds') }}"><span class="badge badge-theme p-2"><i class="fas fa-arrow-left"></i></span></a>
                    Odds Edit Page
                </div>
                <form action="{{route('odds.update',$odds->id)}}" method="POST" id="match-edit">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <div class="label">Matches</div>
                            <input type="hidden" value="{{ $matches['id'] }}" name="match_id">
                            <select name="match_id" class="form-control" id="get_team" disabled>
                                <option value="{{ $matches['id'] }}">{{ $matches['match_name'] }}</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Over Team</div>
                                    <input type="hidden" value="{{ $odds->over_team_id }}" name="over_team_id">
                                    <select name="over_team_id" class="form-control">
                                        <option value="{{ $odds->over_team_id }}">{{ $odds->over_team_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Under Team</div>
                                    <input type="hidden" value="{{ $odds->underteam_id }}" name="underteam_id">
                                    <select name="underteam_id" class="form-control" id="under_team">
                                        <option value="{{ $odds->underteam_id }}">{{ $odds->under_team_name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Body</div>
                                    <input type="text" class="form-control" value="{{ $odds->body_value }}" disabled name="body_value">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Goal Total</div>
                                    <input type="text" class="form-control" value="{{ $odds->goal_total_value }}" disabled name="goal_total_value">
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
{!! JsValidator::formRequest('App\Http\Requests\OddsUpdate', '#match-edit'); !!}
@endsection