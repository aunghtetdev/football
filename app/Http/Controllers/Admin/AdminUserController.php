<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Requests\AdminEdit;
use Yajra\Datatables\Datatables;
use App\Http\Requests\AdminCreate;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->can('view_admin')) {
            return view('backend.admins.index');
        } else {
            return abort('backend.users.index');
        }
    }

    public function ssd()
    {
        $adminuser = AdminUser::query();
        return Datatables::of($adminuser)
        ->addColumn('role', function ($each) {
            $output = '';
            foreach ($each->roles as $role) {
                $output .= '<span class="badge badge-pill btn-theme">'.$role->name.'</span>';
            }
            return $output;
        })
        ->addColumn('action', function ($each) {
            $edit_icon = "";
            $delete_icon = "";

            if (Auth()->user()->can('update_admin')) {
                $edit_icon = '<a href="'.url('admin/home/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            }

            if (Auth()->user()->can('delete_admin')) {
                $delete_icon = '<a href="'.url('admin/home/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            }
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->rawColumns(['role','action'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth()->user()->can('create_admin')) {
            $roles = Role::all();
            return view('backend.admins.create', compact('roles'));
        } else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreate $request)
    {
        $adminuser = new AdminUser();
        $adminuser->username = $request->username;
        $adminuser->password = Hash::make($request->password);
        $roles = $request->roles;
        $adminuser->assignRole($roles);

        $adminuser->save();
        return redirect('/admin/home')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth()->user()->can('update_admin')) {
            $adminuser = AdminUser::findOrFail($id);
            $roles = Role::all();
            $old_roles = $adminuser->roles->pluck('name')->toArray();
            return view('backend.admins.edit', compact('adminuser', 'roles', 'old_roles'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminEdit $request, $id)
    {
        $adminuser = AdminUser::findOrFail($id);
        $adminuser->username = $request->username;
        $adminuser->password = $adminuser->password ?? Hash::make($request->password);
        $adminuser->syncRoles($request->roles);
        $adminuser->update();
        return redirect('/admin/home')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adminuser = AdminUser::findOrFail($id);
        $adminuser->delete();

        return 'success';
    }
}
