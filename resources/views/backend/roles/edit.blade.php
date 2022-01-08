@extends('backend.layouts.app')
@section('role','active')
@section('content')
    @include('backend.layouts.flash')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Role Edit Page
                </div>
                <form action="{{route('roles.update',$role->id)}}" method="POST" id="role-edit">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                        </div>

                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-3">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" value="{{$permission->name}}" name="permissions[]" 
                                    id="name_{{$permission->id}}" @if(in_array($permission->name,$old_permissions)) checked @endif>
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
{!! JsValidator::formRequest('App\Http\Requests\PermissionEdit', '#role-edit'); !!}
@endsection