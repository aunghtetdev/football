<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Wallet;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Helper\UUIDGenerator;
use App\Http\Requests\UserEdit;
use App\Http\Requests\AdminEdit;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Requests\UserCreate;
use App\Http\Requests\AdminCreate;
use Illuminate\Support\Facades\DB;
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
        PermissionChecker::CheckPermission('user');
        return view('backend.users.index');
    }

    public function ssd()
    {
        $user = User::query();
        return Datatables::of($user)
        ->addColumn('action', function ($each) {
            $edit_icon = "";
            $delete_icon = "";

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
        PermissionChecker::CheckPermission('user');
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
        DB::beginTransaction();
        try {
            $user = new User();
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            Wallet::firstOrCreate(
                [
                'user_id' => $user->id
                ],
                [
                'user_code' => UUIDGenerator::UserCode(),
                'amount' => 0
                ]
            );
            DB::commit();
            return redirect('/admin/users')->with('create', 'Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin/users/create')->withErrors(['fail' => 'something wrong'.$e->getMessage()]);
        }
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
        PermissionChecker::CheckPermission('user');
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
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->username = $request->username;
            $user->password = $user->password ?? Hash::make($request->password);
            $user->update();

            Wallet::firstOrCreate(
                [
                'user_id' => $user->id
                ],
                [
                'user_code' => UUIDGenerator::UserCode(),
                'balance' => 0
                ]
            );
            DB::commit();

            return redirect('/admin/users')->with('update', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin/users/'.$user->id.'/edit')->withErrors(['fail' => 'something wrong'.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PermissionChecker::CheckPermission('user');
        $user = User::findOrFail($id);
        $user->delete();

        return 'success';
    }
}
