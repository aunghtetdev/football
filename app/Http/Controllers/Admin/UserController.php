<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Requests\UserEdit;
use App\Http\Requests\AdminEdit;
use Yajra\Datatables\Datatables;
use App\Http\Requests\UserCreate;
use App\Http\Requests\AdminCreate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.index');
    }

    public function ssd()
    {
        $user = User::query();
        return Datatables::of($user)
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.url('admin/users/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            $delete_icon = '<a href="'.url('admin/users/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
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
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreate $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/admin/users')->with('create', 'Created Successfully');
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
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEdit $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->password = $user->password ?? Hash::make($request->password);
        $user->update();
        return redirect('/admin/users')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return 'success';
    }
}
