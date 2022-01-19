@extends('backend.layouts.app')
@section('permission','active')
@section('content')
    @include('backend.layouts.flash')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Permission Edit Page
                </div>
                <form action="{{route('permissions.update',$permission->id)}}" method="POST" id="permission-edit">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $permission->name }}">
                        </div>

                        <div class="form-group">
                            <label for="">ရာထူး</label>
                            <select name="roles[]" class="form-control select-role" multiple>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->name}}" @if(in_array($role->name,$old_roles)) selected @endif>{{$role->name}} 
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
{!! JsValidator::formRequest('App\Http\Requests\PermissionEdit', '#permission-edit'); !!}
@endsection