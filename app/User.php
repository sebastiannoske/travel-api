<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'phone_number', 'city', 'postcode', 'street_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token', 'api_token', 'created_at', 'updated_at'
    ];

    public static function boot() {

        parent::boot();

        static::creating(function($user) {

            $user->token = str_random(30);

        });
    }

    /**
     *  Get travel associated with the user
     */

    public function travel() {

        return $this->hasMany('App\Travel');

    }

    public function roles() {

        return $this->belongsToMany('App\Role');

    }

    public function hasRole($role) {

        if (is_string($role)) {

            return $this->roles->contains('name', $role);

        }

        return !! $role->intersect($this->roles)->count();

    }
}