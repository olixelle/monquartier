<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('neighborhoods')->insert([
            [
                'name' => 'Hameau de Meyzieu',
                'postcode' => '69330',
                'city' => 'Meyzieu',
                'description' => 'Hameau sympathique et bienveillant'
            ]
        ]);
    }
}
