<?php

namespace App\Livewire\Admin\Roles;

use App\Exports\Excel\Admin\Roles\ExcelRoles;
use App\Exports\Pdf\Admin\Roles\PdfRoles;
use App\Models\Admin\Rol;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    public $buscador = '';
    public $paginado = 5;

    // Limpiar el buscador y la paginación al cambiar de pagina
    public function updating($key): void
    {
        if (in_array($key, [
            'buscador',
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.admin.roles.index', [
            'roles' => Rol::select('id', 'name', 'created_at', 'updated_at')
                ->where('name', 'NOT LIKE', 'SuperAdmin')
                ->buscador($this->buscador)
                ->paginate($this->paginado)
        ]);
    }

    public function cargarDatosParaExpotar()
    {
        return Rol::select('name', 'created_at')
            ->where('name', 'NOT LIKE', 'SuperAdmin')
            ->buscador($this->buscador)
            ->orderBy('name')
            ->get();
    }

    public function excel()
    {
        $datos = $this->cargarDatosParaExpotar();
        $encabezados = ['Nombre', 'Creado El'];

        return Excel::download(new ExcelRoles($datos, $encabezados), 'Roles.xlsx');
    }

    public function pdf()
    {
        $nombre_archivo = "Roles";
        $datos = $this->cargarDatosParaExpotar();
        $encabezados = ['Nombre', 'Creado El'];

        return (new PdfRoles($datos, $encabezados, $nombre_archivo))->download();
    }
}
