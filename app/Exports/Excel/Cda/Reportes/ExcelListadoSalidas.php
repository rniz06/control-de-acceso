<?php

namespace App\Exports\Excel\Cda\Reportes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelListadoSalidas implements FromCollection, WithHeadings, WithMapping
{
    public $datos;

    public function __construct($datos = null)
    {
        $this->datos = $datos;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->datos;
    }

    public function headings(): array
    {
        return ['Fecha Salida', 'Vehiculo', 'Registro Salida', 'Empresa', 'Sucursal', 'Acceso'];
    }

    public function map($salida): array
    {
        return [
            !empty($salida->fecha_hora_salida) ? date('d/m/Y H:i:s', strtotime($salida->fecha_hora_salida)) : 'S/D',
            $salida->vehiculo->chapa ?? 'S/D',
            $salida->usuarioRegistroSalida->name ?? 'S/D',
            $salida->empresa->empresa ?? 'S/D',
            $salida->sucursal->sucursal ?? 'S/D',
            $salida->accesoSalida->acceso ?? 'S/D'
        ];
    }
}
