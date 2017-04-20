<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['description', 'city', 'postcode', 'street_address', 'lat', 'long', 'user_id', 'destination_id', 'transportation_mean_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['public', 'user_id', 'destination_id', 'transportation_mean_id', 'created_at', 'updated_at'];

    /**
     *  Get destination associated with the travel
     */

    public function destination() {

        return $this->belongsTo('App\Destination');

    }

    /**
     *  Get user associated with the travel
     */

    public function user() {

        return $this->belongsTo('App\User');

    }

    /**
     *  Get transportation mean associated with the travel
     */

    public function transportation_mean() {

        return $this->belongsTo('App\TransportationMean');

    }

    /**
     *  Get offer associated with the travel
     */

    public function offer() {

        return $this->hasOne('App\TravelOffer');

    }

    /**
     *  Get request associated with the travel
     */

    public function request() {

        return $this->hasOne('App\TravelRequest');

    }

}
