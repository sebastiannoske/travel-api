<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stopover extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['travel_id', 'city', 'postcode', 'street_address', 'lat', 'long'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  Get travel associated with the offer
     */

    public function travel() {

        return $this->belongsTo('App\Travel');

    }
}
