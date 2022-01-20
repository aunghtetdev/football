<?php

namespace App\Http\Controllers\Admin;

use App\Models\Odd;
use App\Models\Team;
use App\Models\Match;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Requests\OddsCreate;
use App\Http\Requests\OddsUpdate;
use App\Http\Controllers\Controller;

class OddController extends Controller
{
    protected $model;

    protected $rView = 'backend.odds.';

    public function __construct(Odd $model)
    {
        return $this->model = $model;
    }

    public function index()
    {
        PermissionChecker::CheckPermission('odds');
        return view($this->rView.'index');
    }

    public function ssd()
    {
        $odd = Odd::query();
        return Datatables::of($odd)
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.url('admin/odds/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            $delete_icon = '<a href="'.url('admin/odds/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->editColumn('over_team_id', function($each) {
            if($each->over_team_id)
            {
                $value = Team::find($each->over_team_id)->name_mm;
                return $value;
            }
        })
        ->editColumn('underteam_id', function($each) {
            if($each->underteam_id)
            {
                $value = Team::find($each->underteam_id)->name_mm;
                return $value;
            }
        })
        ->rawColumns(['finished', 'action'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        PermissionChecker::CheckPermission('odds');
        $matches = Match::where('finished', 0)->get();
        $matches = $this->getMatch($matches);
        return view($this->rView . 'create', compact('matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OddsCreate $request)
    {
        $this->model->create($request->all());
        return redirect('/admin/odds')->with('create', 'Created Successfully');
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
        PermissionChecker::CheckPermission('odds');
        $odds = Odd::findOrFail($id);
        $match = Match::findOrFail($odds->match_id);
        if($match->home_team_id)
        {
            $home_team_name = Team::find($match->home_team_id)->name_mm;
        }
        if($match->away_team_id)
        {
            $away_team_name = Team::find($match->away_team_id)->name_mm;
        }
        $matches = [
            'match_name' => $match->match = $home_team_name.' vs '. $away_team_name,
            'id' => $match->id
        ];
        return view($this->rView.'edit', compact('odds', 'matches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OddsUpdate $request, $id)
    {
        $this->model->find($id)->update($request->all());
        return redirect('/admin/odds')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $odd = Odd::findOrFail($id);
        $odd->delete();

        return 'success';
    }

    protected function getMatch($matches)
    {
        $data = [];
        if($matches)
        {
            foreach ($matches as $query) {
                $is_odds = Odd::where('match_id', $query->id)->first();
                if(!$is_odds)
                {
                    if($query->home_team_id)
                    {
                        $home_team_name = Team::find($query->home_team_id)->name_mm;
                    }
                    if($query->away_team_id)
                    {
                        $away_team_name = Team::find($query->away_team_id)->name_mm;
                    }
                    $query_data = [
                        'match_name' => $query->match = $home_team_name.' vs '. $away_team_name,
                        'id' => $query->id
                    ];
                    $data[] = $query_data; 
                }
                
            }
        }
        return $data;
    }

    public function getAjaxMatchTeam(Request $request)
    {
        $match = Match::select('home_team_id', 'away_team_id')->findOrFail($request->match_id);
        $team = Team::select('name_mm', 'id')
                ->whereIn('id', $match)
                ->get();
        return response()->json($team);
    }
}
