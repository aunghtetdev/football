<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\User;
use App\Models\League;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Requests\TeamEdit;
use App\Http\Requests\UserEdit;
use App\Http\Requests\AdminEdit;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Requests\LeagueEdit;
use App\Http\Requests\TeamCreate;
use App\Http\Requests\UserCreate;
use App\Http\Requests\AdminCreate;
use App\Http\Requests\LeagueCreate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        PermissionChecker::CheckPermission('team');
        return view('backend.teams.index');
    }

    public function ssd()
    {
        $team = Team::query();
        return Datatables::of($team)
        ->addColumn('action', function ($each) {
            $edit_icon = "";
            $delete_icon = "";

            $edit_icon = '<a href="'.url('admin/teams/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            
            $delete_icon = '<a href="'.url('admin/teams/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->editColumn('image', function ($each) {
            return '<img src="'.$each->teamImage().'" style="width: 30px; height:30px; border-radius:100%;" >';
        })
        ->rawColumns(['image','action'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        PermissionChecker::CheckPermission('team');
        return view('backend.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamCreate $request)
    {
        $team = new Team();

        $image_name = null;
        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_name = uniqid().'_'.time().'.'.$image_file->getClientOriginalExtension();
            Storage::disk('public')->put('team/'.$image_name, file_get_contents($image_file));
        }
        
        $team->league_id = $request->league_id;
        $team->name_mm = $request->name_mm;
        // $team->name_en = $request->name_en;
        $team->image = $image_name;
        $team->save();

        return redirect('/admin/teams')->with('create', 'Created Successfully');
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
        PermissionChecker::CheckPermission('team');
        $team = Team::findOrFail($id);
        return view('backend.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamEdit $request, $id)
    {
        $team = Team::findOrFail($id);

        $image_name = $team->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('team/'.$team->image);
            $image_file = $request->file('image');
            $image_name = uniqid().'_'.time().'.'.$image_file->getClientOriginalExtension();
            Storage::disk('public')->put('team/'.$image_name, file_get_contents($image_file));
        }

        $team->league_id = $request->league_id;
        $team->name_mm = $request->name_mm;
        $team->name_en = $request->name_en;
        $team->image = $image_name;
        $team->update();

        return redirect('/admin/teams')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return 'success';
    }
}
