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

        gen_route('User Group');
        gen_route('User');
        gen_route('Role Group');
        gen_route('Area');



    }
}
