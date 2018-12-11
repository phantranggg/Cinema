<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user() {
        return $this->belongsTo('\App\User');
    }

    public function schedule() {
        return $this->belongsTo('\App\Schedule');
    }
}
