@extends('backend.layouts.app')
@section('role','active')
@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Role Create Page
                </div>
                <form action="{{route('roles.store')}}" method="POST" id="role-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-3">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" value="{{$permission->name}}" name="permissions[]" id="name_{{$permission->id}}">
                                    <label class="form-check-label" for="name_{{$permission->id}}"  >{{$permission->name}}</label>
                                </div>
                            </div>
                            @endforeach
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
{!! JsValidator::formRequest('App\Http\Requests\RoleCreate', '#role-create'); !!}

    
@endsection