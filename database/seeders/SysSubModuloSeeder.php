<?php

namespace Database\Seeders;

use App\Models\Admin\SysSubModulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SysSubModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SysSubModulo::create([
            'sub_modulo' => 'USUARIOS',
            'modulo_id' => 1
        ]);

        SysSubModulo::create([
            'sub_modulo' => 'ROLES',
            'modulo_id' => 1
        ]);

        SysSubModulo::create([
            'sub_modulo' => 'PEDIDOS',
            'modulo_id' => 2
        ]);

        SysSubModulo::create([
            'sub_modulo' => 'PROVEEDORES',
            'modulo_id' => 2
        ]);

        SysSubModulo::create([
            'sub_modulo' => 'PRESUPUESTOS',
            'modulo_id' => 2
        ]);

        SysSubModulo::create([
            'sub_modulo' => 'COMPRAS',
            'modulo_id' => 2
        ]);
    }
}
