@extends('backend.layouts.app')
@section('match','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Match Edit Page
                </div>
                <form action="{{route('matches.update',$match->id)}}" method="POST" id="match-edit">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <div class="label">Home Team</div>
                            <select name="home_team_id" class="form-control select2">
                                @foreach($teams as $team)
                                <option value="{{$team->id}}" {{$match->home_team_id == $team->id  ? 'selected' : ''}}>{{ $team->name_mm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="label">Home Team Goal</div>
                            <input type="number" class="form-control" value="{{ $match->home_team_goal }}" name="home_team_goal">
                        </div>
                        <div class="form-group">
                            <div class="label">Away Team</div>
                            <select name="away_team_id" class="form-control select2">
                                @foreach($teams as $team)
                                <option value="{{$team->id}}" {{$match->away_team_id == $team->id ? "selected" : "" }}>{{ $team->name_mm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="label">Away Team Goal</div>
                            <input type="number" class="form-control" value="{{ $match->away_team_goal }}" name="away_team_goal">
                        </div>
                        <div class="form-group">
                            <div class="label">Match Date</div>
                            <input type="date" class="form-control" value="{{ Carbon\Carbon::parse($match->date)->format('Y-m-d') }}" name="date">
                        </div>
                        <div class="form-group">
                            <div class="label">Match Finished</div>
                            <select name="finished" class="form-control">
                                <option value="1" {{$match->finished == 1 ? "selected" : "" }}>Yes</option>
                                <option value="0" {{$match->finished == 0 ? "selected" : "" }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\MatchUpdate', '#match-edit'); !!}
@endsection