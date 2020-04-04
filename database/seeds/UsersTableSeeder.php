<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'user_group_id' => 1,
            'name' => 'Dennys Oliveira',
            'email' => 'dennysaug@gmail.com',
            'password' => bcrypt('root'),
            'active' => 'Y'
        ]);
    }
}
