<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieRoom extends Model
{
    public function movie() {
        return $this->belongsTo('\App\Movie');
    }

    public function room() {
        return $this->belongsTo('\App\Room');
    }

    public function schedules() {
        return $this->hasMany('\App\Schedule');
    }
}
