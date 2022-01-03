@extends('backend.layouts.app')
@section('user','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    User Create Page
                </div>
                <form action="{{route('users.store')}}" method="POST" id="user-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div class="label">Username</div>
                            <input type="text" class="form-control" name="username">
                        </div>
    
                        <div class="form-group">
                            <div class="label">Password</div>
                            <input type="text" class="form-control" name="password">
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
{!! JsValidator::formRequest('App\Http\Requests\UserCreate', '#user-create'); !!}

    
@endsection