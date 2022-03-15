<?php

namespace App\Models;

use App\Models\Moung;
use App\Models\Fixture;
use App\Models\LiveOdd;
use App\Models\OddMoung;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bet extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = [
        'bet_id',
        'user_id',
        'live_odd_id',
        'match_id',
        'over_team_id',
        'under_team_id',
        'bet_team_id',
        'bet_total_goal',
        'bet_amount',
        'win_amount',
        'date',
        'type',
        'bet_result',
        'is_finished',
    ];

    protected $appends = ['over_team_name', 'under_team_name', 'bet_team_name', 'over_team_goal', 'under_team_goal'];
    protected $hidden = ['over_team_id', 'under_team_id', 'bet_team_id', 'created_at', 'updated_at'];

    public function moungs()
    {
        return $this->hasMany(Moung::class);
    }

    public function odd_moungs()
    {
        return $this->hasMany(OddMoung::class,'match_id');
    }

    public function live_odd()
    {
        return $this->belongsTo(LiveOdd::class, 'live_odd_id');
    }

    public function fixture(){
        return $this->belongsTo(Fixture::class,'match_id');
    }
   
    public function getOverTeamNameAttribute()
    {
        if($this->over_team_id)
        {
            $value = Team::findOrFail($this->over_team_id)->name_mm;
        }
        return $value;
    }

    public function getUnderTeamNameAttribute()
    {
        if($this->under_team_id)
        {
            $value = Team::findOrFail($this->under_team_id)->name_mm;
        }
        return $value;
    }

    public function getBetTeamNameAttribute()
    {
        if($this->bet_team_id)
        {
            return Team::findOrFail($this->bet_team_id)->name_mm;
        }
    }

    public function getOverTeamGoalAttribute()
    {
        if($this->match_id)
        {
            return $this->getGoalResult($this->match_id, $this->over_team_id);
        }
    }

    public function getUnderTeamGoalAttribute()
    {
        if($this->match_id)
        {
            return $this->getGoalResult($this->match_id, $this->under_team_id);
        }
    }

    protected function getGoalResult($match_id, $team_id)
    {
        $match = Fixture::findOrFail($match_id);
        if($match)
        {
            // checking home team or away team
            if($team_id == $match->home_team_id)
            {
                return $match->home_team_goal;
            } else {
                return $match->away_team_goal;
            }
        }
    }
}
