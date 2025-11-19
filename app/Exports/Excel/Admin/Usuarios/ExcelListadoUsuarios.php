<?php

namespace App\Exports\Excel\Admin\Usuarios;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelListadoUsuarios implements FromCollection, WithHeadings, WithMapping
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
        return ['Nombre', 'Usuario', 'Email', 'Nro. Cedula', 'Nro. Celular', 'Empresa', 'Sucursal', 'Departamento', 'Obs:', 'Activo', 'Ultimo Acceso'];
    }

    public function map($usuario): array
    {
        $activo = $usuario->activo ? 'Activo' : 'Inactivo';

        return [
            $usuario->name ?? 'S/D',
            $usuario->usuario ?? 'S/D',
            $usuario->email ?? 'S/D',
            $usuario->nro_cedula ?? 'S/D',
            $usuario->nro_celular ?? 'S/D',
            $usuario->empresa->empresa ?? 'S/D',
            $usuario->sucursal->sucursal ?? 'S/D',
            $usuario->departamento->departamento ?? 'S/D',
            $usuario->observacion ?? 'S/D',
            $activo,
            !empty($usuario->ultimo_acceso) ? date('d/m/Y H:i:s', strtotime($usuario->ultimo_acceso)) : 'S/D',
        ];
    }
}
