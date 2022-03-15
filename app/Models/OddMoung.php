<?php

namespace App\Models;

use App\Models\FixtureMoung;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OddMoung extends Model
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

    public function match()
    {
        return $this->belongsTo(FixtureMoung::class, 'match_id');
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
        if($this->underteam_id)
        {
            $value = Team::findOrFail($this->underteam_id)->name_mm;
            return $value;
        }
    }
}
