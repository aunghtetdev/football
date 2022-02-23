<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Match;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Requests\MatchCreate;
use App\Http\Requests\MatchUpdate;
use App\Http\Controllers\Controller;

class MatchController extends Controller
{

    protected $model;

    protected $rView = 'backend.matches.';

    public function __construct(Match $model)
    {
        return $this->model = $model;
    }

    public function index()
    {
        PermissionChecker::CheckPermission('match');
        return view($this->rView.'index');
    }

    public function ssd()
    {
        $match = Match::query();
        return Datatables::of($match)
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.url('admin/matches/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-edit"></i></a>';
            $delete_icon = '<a href="'.url('admin/matches/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->editColumn('home_team_id', function($each) {
            $home_team_name = Team::find($each->home_team_id)->name_mm;
            $away_team_name = Team::find($each->away_team_id)->name_mm;
            if($each->finished == 1)
            {
                $finished = '<span class="badge badge-danger p-2">FT</span>';
            } else {
                $finished = '<span class="badge badge-success p-2">VS</span>';
            }

            return '<div style="text-align:center; border: 2px solid green;border-radius: 10px;padding: 10px;"><div class="row">
                            <div class="col-md-3">'.$home_team_name.'</div>
                            <div class="col-md-1">'.$each->home_team_goal.'</div>
                            <div class="col-md-2">'.$finished.'</div>
                            <div class="col-md-1">'.$each->away_team_goal.'</div>
                            <div class="col-md-3">'.$away_team_name.'</div>
                            <div class="col-md-2">'.$each->date.'</div>
                        <div></div>';
        })
        ->rawColumns(['finished', 'action', 'home_team_id'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        PermissionChecker::CheckPermission('match');
        $teams = Team::select('name_mm', 'id')->get();
        
        return view($this->rView . 'create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatchCreate $request)
    {
        $this->model->create($request->all());
        return redirect('/admin/matches')->with('create', 'Created Successfully');
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
        PermissionChecker::CheckPermission('match');
        $match = Match::findOrFail($id);
        $teams = Team::select('name_mm', 'id')->get();
        return view($this->rView.'edit', compact('match', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatchUpdate $request, $id)
    {
        $this->model->find($id)->update($request->all());
        return redirect('/admin/matches')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $match = Match::findOrFail($id);
        $match->delete();

        return 'success';
    }
}
