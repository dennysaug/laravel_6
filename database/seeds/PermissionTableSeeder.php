<?php

use App\Role;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            'area_id' => 2, //user
            'name' => 'Permission',
            'route' => 'permission/{user}',
            'alias' => "sysadmin.user.permission",
            'method' => 'get',
            'protected' => 'Y'
        ];

        //$role = Role::create($role);

    }
}
