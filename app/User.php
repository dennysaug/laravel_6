<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_group_id','email', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function group()
    {
        return $this->belongsTo('App\UserGroup','user_group_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Role', 'permissions', 'user_id', 'role_id');
    }

    public static function boot()
    {
        parent::boot();

        self::updated(function($model) {
            $role_groups = $model->group->role_groups->pluck('id')->toArray();
            $model->permissions()->sync($role_groups);
        });
    }
}
