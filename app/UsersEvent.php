<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id', 'event_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  Get travel associated with the request
     */
}
