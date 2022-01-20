<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRole;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Requests\UpdateRole;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionEdit;
use App\Http\Requests\StorePermission;
use App\Http\Requests\PermissionCreate;
use App\Http\Requests\UpdatePermission;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        PermissionChecker::CheckPermission('permission');
        $permissions = Permission::all();
        return view('backend.permissions.index', compact('permissions'));
    }

    public function ssd()
    {
        return Datatables::of(Permission::query())
        ->addColumn('action', function ($each) {
            $edit_icon = "";
            $delete_icon = "";

            $edit_icon = '<a href="'.url('/admin/permissions/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            
            $delete_icon = '<a href="'.url('/admin/permissions/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->editColumn('updated_at', function ($each) {
            return $each->updated_at->format('Y-m-d h:i:s A');
        })
        ->make(true);
    }
    
    public function create()
    {
        PermissionChecker::CheckPermission('permission');
        return view('backend.permissions.create');
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
        PermissionChecker::CheckPermission('permission');
        $permission = Permission::findOrFail($id);
        return view('backend.permissions.edit', compact('permission'));
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
