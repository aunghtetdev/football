<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    public function leagueImage()
    {
        if ($this->image) {
            return asset('storage/league/'.$this->image);
        } else {
            return null;
        }
    }
}
