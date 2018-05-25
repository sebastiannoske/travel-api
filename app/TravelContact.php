<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelContact extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'travel_id', 'organisation', 'name', 'email', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at', 'email', 'phone_number'];

    /**
     *  Get travel associated with the offer
     */

    public function travel() {

        return $this->belongsTo('App\Travel');

    }
}
