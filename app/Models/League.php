<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['league_name'];
    

    public function getLeagueNameAttribute()
    {
        if ($this->league_id) {
            $value = Team::find($this->league_id)->name_mm;
            return $value;
        }
    }
    
    public function teams()
    {
        return $this->hasMany('App\Team', 'league_id');
    }

    public function leagueImage()
    {
        if ($this->image) {
            return asset('storage/league/'.$this->image);
        } else {
            return null;
        }
    }
}
