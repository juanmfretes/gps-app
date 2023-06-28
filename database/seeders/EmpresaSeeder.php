<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresa')->insert([
            'razon_social' => 'NGO SAECA',
            'ruc' => '80014137-7',
            'direccion' => 'Av. Gral. José Gervasio Artigas Nro 1502',
            'telefono' => 2880000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('empresa')->insert([
            'razon_social' => 'AJ Vierci SA',
            'ruc' => '80009641-0',
            'direccion' => 'Oliva e/ Montevideo y Ayolas Nro 845',
            'telefono' => 4141111,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('empresa')->insert([
            'razon_social' => 'RETAIL SA',
            'ruc' => '749374-8',
            'direccion' => 'Mcal Lopez Nro 321',
            'telefono' => 123456,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
