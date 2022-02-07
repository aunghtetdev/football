<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Match extends Model
{
    use HasFactory;

    protected $fillable = ['home_team_id','away_team_id','date','home_team_goal', 'away_team_goal', 'finished'];

    protected $appends = ['home_team_name', 'away_team_name', 'match_time', 'match_date'];
    protected $hidden = ['date'];
    public function getHomeTeamNameAttribute()
    {
        if($this->home_team_id){
            $value = Team::find($this->home_team_id)->name_mm;
            return $value;
        }
    }

    public function getAwayTeamNameAttribute()
    {
        if($this->away_team_id){
            $value = Team::find($this->away_team_id)->name_mm;
            return $value;
        }
    }

    public function getMatchTimeAttribute()
    {
        if($this->date)
        {
            $value = Carbon::createFromFormat('Y-m-d H:i:s', $this->date)->format('g:i A');
            return $value;
        }
    }

    public function getMatchDateAttribute()
    {
        if($this->date)
        {
            $value = Carbon::createFromFormat('Y-m-d H:i:s', $this->date)->format('d M');
            return $value;
        }
    }
}
