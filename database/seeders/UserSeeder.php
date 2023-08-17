<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // USUARIO ADMINISTRADOR [NO TIENE EMPRESA]
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // USUARIOS NORMALES
        DB::table('users')->insert([
            'username' => 'noadmin1',
            'email' => 'qwerty@gmail.com',
            'password' => Hash::make('12345678'),
            'admin' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => '1',
        ]);

        DB::table('users')->insert([
            'username' => 'noadmin2',
            'email' => 'asdfg@gmail.com',
            'password' => Hash::make('12345678'),
            'admin' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'empresa_id' => '2'
        ]);
    }
}
