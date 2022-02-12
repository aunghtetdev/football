@extends('backend.layouts.app')
@section('odds','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('admin/odds') }}"><span class="badge badge-theme p-2"><i class="fas fa-arrow-left"></i></span></a>
                    Odds Create Page
                </div>
                <form action="{{route('odds.store')}}" method="POST" id="odds-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div class="label">Matches</div>
                            <select name="match_id" class="form-control select2" id="get_team">
                                <option value="">Select Match</option>
                                @foreach($matches as $match)
                                <option value="{{ $match['id'] }}">{{ $match['match_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row justify-content-center">
                            <div id="loaderIcon" class="spinner-border text-theme" style="display:none;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Over Team</div>
                                    <select name="over_team_id" class="form-control" id="over_team">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Under Team</div>
                                    <select name="underteam_id" class="form-control" id="under_team">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Body</div>
                                    <input type="text" class="form-control" name="body_value">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="label">Goal Total</div>
                                    <input type="text" class="form-control" name="goal_total_value">
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
{!! JsValidator::formRequest('App\Http\Requests\OddsCreate', '#odds-create'); !!}
<script>
$(document).ready(function()
{
$("#get_team").change(function()
{
    $('#loaderIcon').show();
    var match_id=$(this).val();
    console.log(match_id);
    $.ajax
    ({
        type: "POST",
        url: "{{url('/admin/match/teams')}}",
        dataType: 'JSON',
        data: {match_id : match_id},
        cache: false,
        success: function(data)
        {
            $('#loaderIcon').hide();
            $.each(data, function (i, team) {
                $('#over_team').append($('<option>', { 
                    value: team.id,
                    text : team.name_mm 
                }));
                $('#under_team').append($('<option>', { 
                    value: team.id,
                    text : team.name_mm 
                }));
            });
            console.log(data); // I get error and success function does not execute
        } 
    });

    });

    });
</script>
    
@endsection