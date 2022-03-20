@extends('backend.layouts.app')
@section('ad','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Ad Create Page
                </div>
            @include('backend.layouts.flash')

                <form action="{{route('ads.store')}}" method="POST" id="ads-create" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Promotion Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
    
                        <div class="form-group">
                            <label>ကြော်ငြာပုံ</label>
                            <input type="file" class="form-control" name="image" id="ad_image">
                        </div>
                        <div class="preview-img mb-2" >

                        </div> 

                        <div class="form-group">
                            <label for="">Agent Phone 1</label>
                            <input type="text" class="form-control" name="phone1">
                        </div>

                        <div class="form-group">
                            <label for="">Agent Phone 2</label>
                            <input type="text" class="form-control" name="phone2">
                        </div>

                        <div class="form-group">
                            <label for="">Agent Email</label>
                            <input type="text" class="form-control" name="email">
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

    <script>
         $('#ad_image').on('change',function(event){
            var file_length = document.getElementById('ad_image').files.length;
            $('.preview-img').html('');
            for(var i=0; file_length > i ;i++){
                $('.preview-img').append(`<img src=${URL.createObjectURL(event.target.files[i])} style="width: 100px; border-radius:5px;" />`)
            }
        })
    </script>
@endsection