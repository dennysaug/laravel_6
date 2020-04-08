<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name'];

    protected $casts = ['roles'];

    public function roles()
    {
        return $this->hasMany('App\Role');
    }
}
