<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function AdImage()
    {
        if ($this->image) {
            return asset('storage/ads/'.$this->image);
        } else {
            return null;
        }
    }
}
