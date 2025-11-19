<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcayModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            'Toyota' => [
                'Hilux',
                'Corolla',
                'Prado',
                'Fortuner',
                'Yaris',
                'Etios',
                'RAV4',
                'Land Cruiser'
            ],
            'Nissan' => [
                'Frontier',
                'Tiida',
                'Sentra',
                'Versa',
                'Patrol',
                'X-Trail',
                'March',
                'Navara'
            ],
            'Hyundai' => [
                'Tucson',
                'Santa Fe',
                'Elantra',
                'Accent',
                'Creta',
                'H1',
                'i10',
                'Porter'
            ],
            'Kia' => [
                'Sportage',
                'Rio',
                'Cerato',
                'Sorento',
                'Picanto',
                'K2700',
                'Soul'
            ],
            'Chevrolet' => [
                'S10',
                'Onix',
                'Tracker',
                'Cobalt',
                'Spin',
                'Aveo',
                'Cruze'
            ],
            'Volkswagen' => [
                'Gol',
                'Saveiro',
                'Amarok',
                'Voyage',
                'Polo',
                'T-Cross',
                'Fox'
            ],
            'Suzuki' => [
                'Swift',
                'Vitara',
                'S-Cross',
                'Celerio',
                'Jimny',
                'Alto',
                'Baleno'
            ],
            'Mitsubishi' => [
                'L200',
                'Outlander',
                'Montero',
                'ASX',
                'Mirage',
                'Eclipse Cross'
            ],
            'Isuzu' => [
                'D-MAX',
                'Elf',
                'Trooper',
                'Rodeo'
            ],
            'Ford' => [
                'Ranger',
                'Ecosport',
                'Focus',
                'Fiesta',
                'Territory',
                'Everest'
            ],
            'Fiat' => [
                'Strada',
                'Toro',
                'Palio',
                'Cronos',
                'Uno',
                'Siena'
            ],
            'Peugeot' => [
                '208',
                '2008',
                'Partner',
                'Expert',
                '308',
                '307'
            ],
            'Renault' => [
                'Duster',
                'Sandero',
                'Kwid',
                'Logan',
                'Stepway',
                'Oroch'
            ],
            'Chery' => [
                'Tiggo 2',
                'Tiggo 7',
                'Arrizo 5',
                'Fulwin',
                'QQ'
            ],
            'Great Wall' => [
                'Wingle 5',
                'Wingle 7',
                'Poer',
                'Hover'
            ]
        ];

        foreach ($marcas as $marca => $modelos) {
            $marcaId = DB::table('control_acceso.CDA_MARCAS')->insertGetId([
                'marca' => $marca,
                'creado_por' => 1, // ADMINISTRADOR
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($modelos as $modelo) {
                DB::table('control_acceso.CDA_MODELOS')->insert([
                    'modelo' => $modelo,
                    'marca_id' => $marcaId,
                    'creado_por' => 1, // ADMINISTRADOR
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
