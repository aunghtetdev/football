<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreate;
use App\Http\Requests\AdminEdit;
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
        return view('backend.admins.index');
    }

    public function ssd()
    {
        $adminuser = AdminUser::query();
        return Datatables::of($adminuser)
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.url('admin/home/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            $delete_icon = '<a href="'.url('admin/home/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admins.create');
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
        $adminuser = AdminUser::findOrFail($id);
        return view('backend.admins.edit', compact('adminuser'));
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
