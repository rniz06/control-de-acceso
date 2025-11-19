<?php

namespace Database\Seeders;

use App\Models\Admin\SysModulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SysModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SysModulo::create([
            'modulo' => 'ADMIN'
        ]);

        SysModulo::create([
            'modulo' => 'COMPRAS'
        ]);
    }
}
