<?php

namespace Database\Seeders;

use App\Models\Deposito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepositoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Deposito::create([
            'deposito' => 'DEPOSITO 1',
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'creado_por' => 1 //ADMINISTRADOR
        ]);
    }
}
