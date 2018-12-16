<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable=['name', 'hotline', 'row_num', 'column_num', 'fax', 'address', 'status'];
    public function schedules() {
        return $this->hasMany('\App\Schedule');
    }
}
