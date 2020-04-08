<?php

use App\Area;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        Area::insert([
            ['name' => 'User'],
            ['name' => 'User Group'],
            ['name' => 'Area']
        ]);
        */

        $area = ['id' => 1, 'name' => 'Role Groups'];

        gen_route($area);



    }
}
