<?php

namespace App\Exports\Excel\Admin\Roles;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelRoles implements FromCollection, WithHeadings
{
    public $datos, $encabezados;

    public function __construct($datos = null, $encabezados = null)
    {
        $this->datos = $datos;
        $this->encabezados = $encabezados;
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
        return $this->encabezados;
    }

    public function map($rol): array
    {
        return [
            $rol->name ?? 'S/D',
            !empty($rol->created_at) ? date('d/m/Y H:i:s', strtotime($rol->created_at)) : 'S/D',
        ];
    }
}
