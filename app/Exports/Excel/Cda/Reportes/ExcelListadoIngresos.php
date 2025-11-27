<?php

namespace App\Exports\Excel\Cda\Reportes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelListadoIngresos implements FromCollection, WithHeadings, WithMapping
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
        return ['Fecha Ingreso', 'Vehiculo', 'Acceso', 'Guardia'];
    }

    public function map($ingreso): array
    {
        return [
            !empty($ingreso->fecha_hora_ingreso) ? date('d/m/Y H:i:s', strtotime($ingreso->fecha_hora_ingreso)) : 'S/D',
            $ingreso->vehiculo->chapa ?? 'S/D',
            $ingreso->accesoIngreso->acceso ?? 'S/D',
            $ingreso->usuarioRegistroIngreso->name ?? 'S/D',
        ];
    }
}
