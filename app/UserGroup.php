<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $fillable = ['name'];

    public function role_groups()
    {
        return $this->belongsToMany('App\Role', 'role_groups', 'user_group_id', 'role_id');
    }
}
