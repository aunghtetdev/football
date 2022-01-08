<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function teamImage()
    {
        if ($this->image) {
            return asset('storage/team/'.$this->image);
        } else {
            return null;
        }
    }
}
