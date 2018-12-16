<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['user_id2', 'status'];

    public function users() {
        return $this->hasMany('\App\User');
    }
}
