@extends('backend.layouts.app')
@section('league','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    League Edit Page
                </div>
                <form action="{{route('leagues.update',$league->id)}}" method="POST" enctype="multipart/form-data" id="league-edit">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name (MM)</label>
                                <input type="text" class="form-control" name="name_mm" value="{{$league->name_mm}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Name (EN)</label>
                                <input type="text" class="form-control" name="name_en" value="{{$league->name_en}}">
                            </div>
    
                            <div class="form-group">
                                <label for="">Order</label>
                                <input type="text" class="form-control" name="order" value="{{$league->order}}">
                            </div>
    
                            {{-- <div class="form-group">
                                <div class="label">Image</div>
                                <input type="file" class="form-control" name="image" id="league_image">
                            </div>
                            <div class="preview-img" >
                                <img src="{{$league->leagueImage()}}" style="width: 50px; border-radius:5px;">
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
{!! JsValidator::formRequest('App\Http\Requests\LeagueEdit', '#league-edit'); !!}

<script>
    $(document).ready(function(){
        $('#league_image').on('change',function(event){
            var file_length = document.getElementById('league_image').files.length;
            $('.preview-img').html('');
            for(var i=0; file_length > i ;i++){
                $('.preview-img').append(`<img src=${URL.createObjectURL(event.target.files[i])} style="width: 50px; border-radius:5px;" />`)
            }
        })
    })
</script>
@endsection