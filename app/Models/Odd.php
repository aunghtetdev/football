<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odd extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'over_team_id',
        'underteam_id',
        'body_value',
        'goal_total_value',
        'type'
    ];

    protected $appends = ['over_team_name', 'under_team_name'];

    public function getOverTeamNameAttribute()
    {
        if($this->over_team_id)
        {
            $value = Team::findOrFail($this->over_team_id);
        }
        return $value;
    }
    public function getUnderTeamNameAttribute()
    {
        if($this->underteam_id)
        {
            $value = Team::findOrFail($this->underteam_id);
            return $value;
        }
    }
    
}
