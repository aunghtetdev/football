@extends('backend.layouts.app')
@section('team','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Team Edit Page
                </div>
                <form action="{{route('teams.update',$team->id)}}" method="POST" enctype="multipart/form-data" id="team-edit">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">League</label>
                                <select name="league_id" class="form-control" id="">
                                    <option value="">Select League</option>
                                    @foreach($leagues as $league)
                                    <option value="{{$league->id}}" @if($team->league_id == $league->id) selected @endif>{{$league->name_mm}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Name (MM)</label>
                                <input type="text" class="form-control" name="name_mm" value="{{$team->name_mm}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Name (EN)</label>
                                <input type="text" class="form-control" name="name_en" value="{{$team->name_en}}">
                            </div>
    
                            {{-- <div class="form-group">
                                <div class="label">Image</div>
                                <input type="file" class="form-control" name="image" id="team_image">
                            </div>
                            <div class="preview-img" >
                                <img src="{{$team->teamImage()}}" style="width: 50px; border-radius:5px;">
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-theme ml-3" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\TeamEdit', '#team-edit'); !!}

<script>
    $(document).ready(function(){
        $('#team_image').on('change',function(event){
            var file_length = document.getElementById('team_image').files.length;
            $('.preview-img').html('');
            for(var i=0; file_length > i ;i++){
                $('.preview-img').append(`<img src=${URL.createObjectURL(event.target.files[i])} style="width: 50px; border-radius:5px;" />`)
            }
        })
    })
</script>
@endsection