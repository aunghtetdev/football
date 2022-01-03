@extends('backend.layouts.app')
@section('admin','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Admin Edit Page
                </div>
                <form action="{{route('home.update',$adminuser->id)}}" method="POST" id="admin-edit">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <div class="label">Username</div>
                            <input type="text" class="form-control" name="username" value="{{ $adminuser->username }}">
                        </div>
    
                        <div class="form-group">
                            <div class="label">Password</div>
                            <input type="text" class="form-control" name="password" >
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
{!! JsValidator::formRequest('App\Http\Requests\AdminEdit', '#admin-edit'); !!}
@endsection