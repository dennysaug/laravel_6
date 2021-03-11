<?php

use App\Role;
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


        gen_route('Dashboard');
//        gen_route('Product');
//        Role::create(
//            [
//                'area_id' => 10,
//                'name' => 'Order',
//                'route' => 'order',
//                'alias' => 'sysadmin.product.order',
//                'method' => 'post',
//                'protected' => 'Y'
//
//            ]
//        );

    }
}
