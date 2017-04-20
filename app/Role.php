<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public $timestamps = false;

    public function permissions() {

        return $this->belongsToMany('App\Permission');

    }

    public function givePermissionTo(Permission $permission) {

        return $this->permissions()->save($permission);

    }

}
