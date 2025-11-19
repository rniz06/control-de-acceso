<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sucursal::create([
            'sucursal' => 'GRUPO SERVIPAR ASUNCION',
            'razon_social' => 'GRUPO SEVIPAR S.A',
            'ruc' => '80045670-0',
            'correo' => 'info@servipar.com',
            'direccion' => 'Teniente Aguirre 1237 esq. Coronel Rivarola y Facundo Machain, Asunción, Paraguay',
            'telefono' => '021 502 292',
            'empresa_id' => 1,
            'creado_por' => 1 //ADMINISTRADOR
        ]);

        Sucursal::create([
            'sucursal' => 'CENTRO LOGISTICO',
            'razon_social' => 'DIAZ E HIJOS S.A',
            'ruc' => '80013876-7',
            'correo' => 'contabilidad@luisito.com.py',
            'direccion' => 'AVDA. EUSEBIO AYALA E/R.I. 3 CORRALES',
            'telefono' => '522200',
            'empresa_id' => 2, // HIPERMERCADO LUISITO
            'creado_por' => 1 //ADMINISTRADOR
        ]);
    }
}
