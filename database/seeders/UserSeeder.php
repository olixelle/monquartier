<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => 'Olivier',
                'email' => 'olivier@gmail.com',
                'password' => bcrypt('olivier2'),
                'neighborhood_id' => 1,
            ],
            [
                'name' => 'Naji',
                'email' => 'naji@gmail.com',
                'password' => bcrypt('olivier2'),
                'neighborhood_id' => 1,
            ],
            [
                'name' => 'Axelle',
                'email' => 'axelle@gmail.com',
                'password' => bcrypt('olivier2'),
                'neighborhood_id' => 1,
            ],
            [
                'name' => 'Mathieu',
                'email' => 'mathieu@gmail.com',
                'password' => bcrypt('olivier2'),
                'neighborhood_id' => 1,
            ],
        ]);
    }
}
