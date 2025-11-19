<?php

namespace Database\Seeders;

use App\Models\Cda\Vehiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehiculo::create([
            'chapa'      => '0',
            'marca_id'   => 1,
            'modelo_id'  => 1,
            'color_id'   => 1,
            'creado_por' => 1
        ]);
    }
}
