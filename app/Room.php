<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function theater() {
        return $this->belongsTo('\App\Theater');
    }

    public function movieRooms() {
        return $this->hasMany('\App\MovieRoom');
    }
}
