<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    const ACTIVE = 1;
    const INACTIVE = 0;
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    const PATH_AVATAR = 'uploads/users/avatars/';
    const PATH_AVATAR_DEFAULT = 'uploads/users/avatars/default.png';
    const CAN_NOT_DELETE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth', 'phone', 'address', 'account_type', 'role', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function likes() {
        return $this->hasMany('\App\Like');
    }

    public function tickets() {
        return $this->hasMany('\App\Ticket');
    }

    public function isAdmin() {
        if (Auth::user()->role == "admin") {
            return true;
        }
        return false;
    }
    
    public function movies() {
        return $this->belongsToMany('App\Movie', 'likes');
    }
}
