<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehiculos')->insert([
            'imei' => 7483650274,
            'chapa' => 'ANF 783',
            'marca' => 'BMW',
            'modelo' => 'X6',
            'conductor' => 'Javier Lopez',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 2,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 4769275927,
            'chapa' => 'KND 739',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'conductor' => 'Mario Benitez',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 1,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 5863628572,
            'chapa' => 'VFU 547',
            'marca' => 'Ford',
            'modelo' => 'Focus',
            'conductor' => 'Felix Morel',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 1,
        ]);
    }
}
