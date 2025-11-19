<?php

namespace Database\Seeders;

use App\Models\Impuesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Impuesto::create([
            'impuesto' => 'SIN ESPECIFICAR',
            'porcentaje' => 0,
            'siglas' => 'SIN ESPECIFICAR',
            'creado_por' => 1 //ADMINISTRADOR
        ]);

        Impuesto::create([
            'impuesto' => 'IVA 10%',
            'porcentaje' => 10,
            'siglas' => 'IVA',
            'creado_por' => 1 //ADMINISTRADOR
        ]);

        Impuesto::create([
            'impuesto' => 'IVA 5%',
            'porcentaje' => 5,
            'siglas' => '',
            'creado_por' => 1 //ADMINISTRADOR
        ]);

        Impuesto::create([
            'impuesto' => 'EXCENTA',
            'porcentaje' => 0,
            'siglas' => 'EXCENTA',
            'creado_por' => 1 //ADMINISTRADOR
        ]);
    }
}
