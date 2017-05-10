<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['event_id', 'template_name', 'title', 'content', 'closing'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  Get event associated with the destination
     */

    public function event() {

        return $this->belongsTo('App\Event');

    }
}
