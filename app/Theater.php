<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function rooms() {
        return $this->hasMany('\App\Room');
    }
}
