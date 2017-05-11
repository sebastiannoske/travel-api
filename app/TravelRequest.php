<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['travel_id', 'passenger', 'cost'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  Get travel associated with the request
     */

    public function travel() {

        return $this->belongsTo('App\Travel');

    }

}
