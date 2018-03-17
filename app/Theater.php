<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function movies() {
        return $this->belongsToMany('\App\Movie', 'schedules');
    }
}
