<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    protected $fillable = ['area_id', 'name', 'route', 'alias', 'method', 'protected'];

    public static function boot()
    {
        parent::boot();

        self::created(function($model) {
            $user = Auth::loginUsingId(1);
            $role_groups = $user->group->role_groups->pluck('id')->toArray();
            $permissions = $user->permissions->pluck('id')->toArray();

            array_push($role_groups,$model->id);
            array_push($permissions,$model->id);

            $user->group->role_groups()->sync($role_groups);
            $user->permissions()->sync($permissions);
        });

    }

}
