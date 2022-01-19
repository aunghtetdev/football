@extends('backend.layouts.app')
@section('admin','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Admin Create Page
                </div>
                <form action="{{route('home.store')}}" method="POST" id="admin-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
    
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <label for="">ရာထူး</label>
                            <select name="roles" class="form-control select-role">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->name}}" >{{$role->name}} 
                                </option>
                                @endforeach
                            </select>
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
{!! JsValidator::formRequest('App\Http\Requests\AdminCreate', '#admin-create'); !!}

    
@endsection