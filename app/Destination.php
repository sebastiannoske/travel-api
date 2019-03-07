<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'event_id', 'postcode', 'street_address', 'pin_color', 'lat', 'long', 'date'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  Get travel associated with the destination
     */

    public function travel() {

        return $this->hasMany('App\Travel');

    }

    /**
     *  Get event associated with the destination
     */

    public function event() {

        return $this->belongsTo('App\Event');

    }
}
