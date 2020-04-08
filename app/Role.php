<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['area_id', 'name', 'route', 'alias', 'method', 'protected'];

}
