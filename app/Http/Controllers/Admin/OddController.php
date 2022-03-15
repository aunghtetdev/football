<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Odd;
use App\Models\Team;
use App\Models\Fixture;
use App\Models\LiveOdd;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Requests\OddsCreate;
use App\Http\Requests\OddsUpdate;
use Illuminate\Support\Facades\DB;
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
        $odd = Odd::query()->orderBy('updated_at', 'DESC');
        return Datatables::of($odd)
        ->addColumn('status', function ($each) {
            if ($each->match ?$each->match->finished : 1 == 1) {
                return '<span class="badge badge-pill badge-danger p-2">Finished</span>';
            }else{
                return '<span class="badge badge-pill badge-success p-2">Live</span>';
            }
        })
        ->addColumn('action', function ($each) {
            $edit_icon = '<a href="'.url('admin/odds/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-edit"></i></a>';
            $delete_icon = '<a href="'.url('admin/odds/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            $change_odds = '<a href="'.url('admin/odds/change-odds/'.$each->id).'" class="btn btn-theme">Change Odds</a>';
            return '<div class="action-icon">'.$change_odds . $edit_icon . $delete_icon.'</div>';
        })
        ->editColumn('body_value', function ($each) {
            if ($each->id) {
                $value = LiveOdd::where('odd_id', $each->id)->orderBy('id', 'desc')->first()->body_value;
                return $value;
            }
        })
        ->editColumn('goal_total_value', function ($each) {
            if ($each->underteam_id) {
                $value = LiveOdd::where('odd_id', $each->id)->orderBy('id', 'desc')->first()->goal_total_value;
                return $value;
            }
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function changeOdds($odd_id)
    {
        $live_odds = LiveOdd::where('odd_id', $odd_id)->orderBy('id', 'desc')->first();
        return view($this->rView.'change_odds', compact('live_odds'));
    }

    public function saveChangeOdds(Request $request)
    {
        $live_odd = LiveOdd::where('odd_id', $request->odd_id)->orderBy('id', 'desc')->first();
        $live_odd->live = 0;
        
        LiveOdd::create([
            'odd_id' => $request->odd_id,
            'body_value' => $request->body_value,
            'goal_total_value' => $request->goal_total_value,
            'datetime' => date('Y-m-d H:i:s'),
            'live' => 1
        ]);
        $live_odd->save();

        return redirect('/admin/odds')->with('create', 'Changed Successfully');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        PermissionChecker::CheckPermission('odds');
        $matches = Fixture::where('finished', 0)->get();
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
        // dd($request->all());
        DB::beginTransaction();
        try {
            $odd = $this->model->create($request->all());
            // dd($odd);
            LiveOdd::create([
                'odd_id' => $odd->id,
                'body_value' => $request->body_value,
                'goal_total_value' => $request->goal_total_value,
                'datetime' => date('Y-m-d H:i:s'),
                'live' => 1
            ]);

            DB::commit();
            return redirect('/admin/odds')->with('create', 'Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('admin/odds/create')->withErrors(['fail' => 'Something wrong'.$e->getMessage()]);
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
        PermissionChecker::CheckPermission('odds');
        $odds = Odd::findOrFail($id);
        $match = Fixture::findOrFail($odds->match_id);
        if ($match->home_team_id) {
            $home_team_name = Team::find($match->home_team_id)->name_mm;
        }
        if ($match->away_team_id) {
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
        if ($matches) {
            foreach ($matches as $query) {
                $is_odds = Odd::where('match_id', $query->id)->first();
                if (!$is_odds) {
                    if ($query->home_team_id) {
                        $home_team_name = Team::find($query->home_team_id)->name_mm;
                    }
                    if ($query->away_team_id) {
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
        $match = Fixture::select('home_team_id', 'away_team_id')->findOrFail($request->match_id);
        $team = Team::select('name_mm', 'id')
                ->whereIn('id', $match)
                ->get();
        return response()->json($team);
    }
}
