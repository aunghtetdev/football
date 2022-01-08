<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRole;
use Yajra\Datatables\Datatables;
use App\Http\Requests\UpdateRole;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionCreate;
use App\Http\Requests\PermissionEdit;
use App\Http\Requests\StorePermission;
use App\Http\Requests\UpdatePermission;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        if (Auth()->user()->can('view_permission')) {
            $permissions = Permission::all();
            return view('backend.permissions.index', compact('permissions'));
        } else {
            return abort(404);
        }
    }

    public function ssd()
    {
        return Datatables::of(Permission::query())
        ->addColumn('action', function ($each) {
            $edit_icon = "";
            $delete_icon = "";
            if (Auth()->user()->can('update_permission')) {
                $edit_icon = '<a href="'.url('/admin/permissions/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            }
            if (Auth()->user()->can('delete_permission')) {
                $delete_icon = '<a href="'.url('/admin/permissions/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            }
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->editColumn('updated_at', function ($each) {
            return $each->updated_at->format('Y-m-d h:i:s A');
        })
        ->make(true);
    }
    
    public function create()
    {
        if (Auth()->user()->can('create_permission')) {
            return view('backend.permissions.create');
        } else {
            return abort(404);
        }
    }

    public function store(PermissionCreate $request)
    {
        $permissions = new Permission();
        $permissions->name = $request->name;
           
        $permissions->save();
    
        return redirect('admin/permissions')->with('create', 'Created Successfully');
    }
    
    
    public function edit($id)
    {
        if (Auth()->user()->can('update_permission')) {
            $permission = Permission::findOrFail($id);
            return view('backend.permissions.edit', compact('permission'));
        } else {
            return abort(404);
        }
    }

    public function update(PermissionEdit $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $permission->name = $request->name;
       
        $permission->update();
        
        return redirect('admin/permissions')->with('update', 'Updated Successfully');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return 'success';
    }
}
