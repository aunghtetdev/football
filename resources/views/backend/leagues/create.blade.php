@extends('backend.layouts.app')
@section('league','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    League Create Page
                </div>
                <form action="{{route('leagues.store')}}" method="POST" id="league-create" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div class="label">Name (MM)</div>
                            <input type="text" class="form-control" name="name_mm">
                        </div>
                        
                        <div class="form-group">
                            <div class="label">Name (EN)</div>
                            <input type="text" class="form-control" name="name_en">
                        </div>

                        <div class="form-group">
                            <div class="label">Order</div>
                            <input type="text" class="form-control" name="order">
                        </div>

                        <div class="form-group">
                            <div class="label">Image</div>
                            <input type="file" class="form-control" name="image" id="league_image">
                        </div>
                        <div class="preview-img" >

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
{!! JsValidator::formRequest('App\Http\Requests\LeagueCreate', '#league-create'); !!}
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