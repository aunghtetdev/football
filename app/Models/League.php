<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $guarded = [];
    
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
