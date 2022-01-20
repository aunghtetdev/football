<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleEdit;
use App\Http\Requests\StoreRole;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Requests\RoleCreate;
use App\Http\Requests\UpdateRole;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        PermissionChecker::CheckPermission('role');
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    public function ssd()
    {
        return Datatables::of(Role::query())
        ->addColumn('permission', function ($each) {
            $output = '';
            foreach ($each->permissions as $permission) {
                $output .= '<span class="badge badge-pill badge-success p-1 m-1">'.$permission->name.'</span>';
            }
            return $output;
        })
        ->editColumn('updated_at', function ($each) {
            return $each->updated_at->format('Y-m-d h:i:s A');
        })
        ->addColumn('action', function ($each) {
            $edit_icon = "";
            $delete_icon = "";

            $edit_icon = '<a href="'.url('/admin/roles/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            
            $delete_icon = '<a href="'.url('/admin/roles/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->rawColumns(['permission','action'])
        ->make(true);
    }
    
    public function create()
    {
        PermissionChecker::CheckPermission('role');
        $permissions = Permission::all();
        return view('backend.roles.create', compact('permissions'));
    }

    public function store(RoleCreate $request)
    {
        $roles = new Role();
        $roles->name = $request->name;
        $permissions = $request->permissions;
        $roles->givePermissionTo($permissions);

        $roles->save();
    
        return redirect('admin/roles')->with('create', 'Created Successfully');
    }
    
    
    public function edit($id)
    {
        PermissionChecker::CheckPermission('role');
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $old_permissions = $role->permissions->pluck('name')->toArray();

        return view('backend.roles.edit', compact('role', 'permissions', 'old_permissions'));
        
    }

    public function update(RoleEdit $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->name = $request->name;
        $permissions = $request->permissions;
        
        $old_permissions = $role->permissions->pluck('name')->toArray();
        
        $role->revokePermissionTo($old_permissions);
        $role->givePermissionTo($permissions);
        
        $role->update();
        
        return redirect('admin/roles')->with('update', 'Updated Successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return 'success';
    }
}
