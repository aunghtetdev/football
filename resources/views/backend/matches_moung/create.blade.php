@extends('backend.layouts.app')
@section('match-moung','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Match Moung Create Page
                </div>
                <form action="{{route('moung.store')}}" method="POST" id="match-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div class="label">Home Team</div>
                            <select name="home_team_id" class="form-control select-role">
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name_mm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="label">Away Team</div>
                            <select name="away_team_id" class="form-control select-role">
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name_mm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="label">Match Date</div>
                            <input id="daterangepicker" autocomplete="off" class="form-control" name="date" type="text" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-theme" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\MatchCreate', '#match-create'); !!}
    

@endsection