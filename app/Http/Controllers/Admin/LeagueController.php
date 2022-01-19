<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\League;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Requests\UserEdit;
use App\Http\Requests\AdminEdit;
use Yajra\Datatables\Datatables;
use App\Http\Requests\LeagueEdit;
use App\Http\Requests\UserCreate;
use App\Http\Requests\AdminCreate;
use App\Http\Requests\LeagueCreate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->can('view_league')) {
            return view('backend.leagues.index');
        } else {
            return abort(404);
        }
    }

    public function ssd()
    {
        $league = League::query();
        return Datatables::of($league)
        ->addColumn('action', function ($each) {
            $edit_icon = "";
            $delete_icon = "";

            if (Auth()->user()->can('update_league')) {
                $edit_icon = '<a href="'.url('admin/leagues/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            }
            if (Auth()->user()->can('delete_league')) {
                $delete_icon = '<a href="'.url('admin/leagues/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            }
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->editColumn('image', function ($each) {
            return '<img src="'.$each->leagueImage().'" style="width: 30px; height:30px; border-radius:100%;" >';
        })
        ->editColumn('active', function ($each) {
            return '<input type="checkbox" checked data-toggle="toggle" data-size="xs" id="toggle-event" data-id="'.$each->id.'" data-active="'.$each->active.'">';
        })
        ->rawColumns(['image','active','action'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth()->user()->can('create_league')) {
            return view('backend.leagues.create');
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
    public function store(LeagueCreate $request)
    {
        $league = new League();

        $image_name = null;
        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_name = uniqid().'_'.time().'.'.$image_file->getClientOriginalExtension();
            Storage::disk('public')->put('league/'.$image_name, file_get_contents($image_file));
        }

        $league->name_mm = $request->name_mm;
        $league->name_en = $request->name_en;
        $league->order = $request->order;
        $league->image = $image_name;
        $league->save();

        return redirect('/admin/leagues')->with('create', 'Created Successfully');
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

    public function toggle($id)
    {
        $toggle = League::findOrFail($id);
        if ($toggle->active == 1) {
            $toggle->update([
                'active'=>'0'
            ]);
        } else {
            $toggle->update([
                'active'=>'1'
            ]);
        }
        return response([
            'status' => 'success'
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth()->user()->can('update_league')) {
            $league = League::findOrFail($id);
            return view('backend.leagues.edit', compact('league'));
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
    public function update(LeagueEdit $request, $id)
    {
        $league = League::findOrFail($id);

        $image_name = $league->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('league/'.$league->image);
            $image_file = $request->file('image');
            $image_name = uniqid().'_'.time().'.'.$image_file->getClientOriginalExtension();
            Storage::disk('public')->put('league/'.$image_name, file_get_contents($image_file));
        }

        $league->name_mm = $request->name_mm;
        $league->name_en = $request->name_en;
        $league->order = $request->order;
        $league->image = $image_name;
        $league->update();

        return redirect('/admin/leagues')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $league = League::findOrFail($id);
        $league->delete();

        return 'success';
    }
}