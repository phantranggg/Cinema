<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $fillable=['type','show_time','show_date','price', 'movie_id', 'theater_id', 'status'];
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
