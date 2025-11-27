<?php

namespace Database\Seeders;

use App\Models\Admin\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [

            'Vehiculos Listar',
            'Vehiculos Crear',
            'Vehiculos Editar',
            'Vehiculos Eliminar',

            'Marcas Listar',
            'Marcas Crear',
            'Marcas Editar',
            'Marcas Eliminar',

            'Modelos Listar',
            'Modelos Crear',
            'Modelos Editar',
            'Modelos Eliminar',

            'Colores Listar',
            'Colores Crear',
            'Colores Editar',
            'Colores Eliminar',

            'Reportes Ingresos Listar',
            'Reportes Salidas Listar',
        ];

        foreach ($permisos as $permiso) {
            Permiso::create([
                'name'          => $permiso,
            ]);
        }
    }
}
