<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportationMean extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  Get travel associated with the transportation mean
     */

    public function travel() {

        return $this->hasMany('App\Travel');

    }
}
