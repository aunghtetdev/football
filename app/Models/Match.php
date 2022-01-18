<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $fillable = ['home_team_id','away_team_id','date','home_team_goal', 'away_team_goal', 'finished'];

    public function getHomeTeamNameAttribute($home_team_id)
    {
        if($home_team_id){
            $value = Team::find($home_team_id)->name_mm;
            return $value;
        }
    }

    public function getAwayTeamNameAttribute($away_team_id)
    {
        if($away_team_id){
            $value = Team::find($away_team_id)->name_mm;
            return $value;
        }
    }
}
