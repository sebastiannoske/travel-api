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

    protected $fillable = ['description', 'link', 'departure_time', 'city', 'postcode', 'street_address', 'lat', 'long', 'user_id', 'destination_id', 'transportation_mean_id', 'distance'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['public', 'user_id', 'destination_id', 'transportation_mean_id', 'token', 'verified', 'created_at', 'updated_at'];

    public static function boot() {

        parent::boot();

        static::creating(function($travel) {

            $travel->token = str_random(30);
            $travel->url_token = str_random(4);

        });
    }

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

    /**
     *  Get stopover associated with the travel
     */

    public function stopover() {

        return $this->hasMany('App\Stopover');

    }


    public function contact() {

        return $this->hasOne('App\TravelContact');

    }
}
