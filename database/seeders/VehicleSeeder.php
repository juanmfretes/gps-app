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
            'imei' => 2749572958,
            'chapa' => 'KFB 957',
            'marca' => 'Ford',
            'modelo' => 'Figo',
            'conductor' => 'Lucía Acosta',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 1,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 3857206739,
            'chapa' => 'OEM 720',
            'marca' => 'Mazda',
            'modelo' => 'CX-5',
            'conductor' => 'Luis Suarez',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 1,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 4746592750,
            'chapa' => 'SUT 659',
            'marca' => 'Audi',
            'modelo' => 'A3',
            'conductor' => 'Horacio Martinez',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 1,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 5837562960,
            'chapa' => 'FUR 756',
            'marca' => 'Nissan',
            'modelo' => 'March',
            'conductor' => 'Mirta Medina',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 1,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 5264957395,
            'chapa' => 'UFX 499',
            'marca' => 'Jeep',
            'modelo' => 'Compass',
            'conductor' => 'Claudia Aguirre',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 1,
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

        DB::table('vehiculos')->insert([
            'imei' => 6503650274,
            'chapa' => 'KFF 593',
            'marca' => 'Kia',
            'modelo' => 'Sorento',
            'conductor' => 'Ana Lopez',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 2,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 7542295739,
            'chapa' => 'WCY 229',
            'marca' => 'Toyota',
            'modelo' => 'IST',
            'conductor' => 'Pablo Sosa',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 2,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 7364992663,
            'chapa' => 'PEI 649',
            'marca' => 'Citroen',
            'modelo' => 'C3',
            'conductor' => 'Cesar García',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 2,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 4759375920,
            'chapa' => 'EBG 283',
            'marca' => 'Toyota',
            'modelo' => 'Platz',
            'conductor' => 'Julio Romero',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 2,
        ]);

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
            'imei' => 3486773922,
            'chapa' => 'QWC 867',
            'marca' => 'Seat',
            'modelo' => 'Ibiza',
            'conductor' => 'Patricia Gimenez',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 2,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 5399264115,
            'chapa' => 'JMK 992',
            'marca' => 'Ford',
            'modelo' => 'Escape',
            'conductor' => 'Norma Alvarez',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 2,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 1749305738,
            'chapa' => 'IDH 385',
            'marca' => 'Hyundai',
            'modelo' => 'i20',
            'conductor' => 'Mónica Flores',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 3,
        ]);

        DB::table('vehiculos')->insert([
            'imei' => 6883649256,
            'chapa' => 'RTX 364',
            'marca' => 'Toyota',
            'modelo' => 'Hilux',
            'conductor' => 'Graciela Torrez',
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => 3,
        ]);
    }
}
