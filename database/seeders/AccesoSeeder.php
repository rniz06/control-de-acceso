<?php

namespace Database\Seeders;

use App\Models\Acceso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Acceso::create(['acceso' => 'SIN DEFINIR', 'empresa_id' => 1, 'sucursal_id' => 1, 'creado_por' => 1]);

        Acceso::create(['acceso' => 'PRINCIPAL', 'empresa_id' => 1, 'sucursal_id' => 1, 'creado_por' => 1]);

        Acceso::create(['acceso' => 'OTRO', 'empresa_id' => 1, 'sucursal_id' => 1, 'creado_por' => 1]);
    }
}
