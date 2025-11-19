<?php

namespace Database\Seeders;

use App\Models\Cda\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colores = [
            'Blanco',
            'Negro',
            'Rojo',
            'Rosado',
            'Verde',
            'Azul',
            'Amarillo',
            'Naranja',
            'Dorado',
            'Cromado',
            'Gris claro',
            'Plateado',
            'Celeste'
        ];

        foreach ($colores as $color) {
            Color::create([
                'color'      => $color,
                'creado_por' => 1, // ADMINISTRADOR
            ]);
        }
    }
}
