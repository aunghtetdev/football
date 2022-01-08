@extends('backend.layouts.app')
@section('user','active')
@section('content')
    @include('backend.layouts.flash')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    User Edit Page
                </div>
                <form action="{{route('users.update',$user->id)}}" method="POST" id="user-edit">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                        </div>
    
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password" >
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
{!! JsValidator::formRequest('App\Http\Requests\UserEdit', '#user-edit'); !!}
@endsection