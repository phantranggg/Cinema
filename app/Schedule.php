<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function tickets() {
        return $this->hasMany('\App\Ticket');
    }

    public function movie() {
        return $this->belongsTo('App\Movie');
    }

    public function theater() {
        return $this->belongsTo('\App\Theater');
    }
}
