<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleGroup extends Model
{
    protected $fillable = ['user_group_id', 'role_id'];
}
