<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'campaignText', 'imagePath'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  Get destinations associated with the event
     */

    public function destinations() {

        return $this->hasMany('App\Destination');

    }

    public function users() {

        return $this->hasMany('App\UsersEvent');

    }
}
