<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function schedules() {
        return $this->hasMany('\App\Schedule');
    }
}
