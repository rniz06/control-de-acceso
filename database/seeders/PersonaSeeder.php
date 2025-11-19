<?php

namespace Database\Seeders;

use App\Models\Cda\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Persona::create([
            'nombre_completo'   => 'SIN DEFINIR',
            'nro_cedula'        => '0',
            'nro_celular'       => null,
            'esPersonalEmpresa' => true,
            'empresa_id'        => null,
            'sucursal_id'       => null,
            'creado_por'        => 1 // ADMINISTRADOR
        ]);
    }
}
