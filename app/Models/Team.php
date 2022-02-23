<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $appends = ['league_name'];
    

    public function getLeagueNameAttribute()
    {
        if ($this->league_id) {
            $value = Team::find($this->league_id)->name_mm;
            return $value;
        }
    }
    
    public function teamImage()
    {
        if ($this->image) {
            return asset('storage/team/'.$this->image);
        } else {
            return null;
        }
    }
}
