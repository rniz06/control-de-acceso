<?php

namespace App\Livewire\Admin\Empresas;

use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $buscarEmpresa = '', $buscarRazonSocial = '', $buscarRuc = '', $buscarCorreo = '', $buscarTelefono = '', $buscarDireccion = '';
    public $paginado = 5;

    // Limpiar el buscador y la paginación al cambiar de pagina
    public function updating($key): void
    {
        if (in_array($key, [
            'buscarEmpresa',
            'buscarRazonSocial',
            'buscarRuc',
            'buscarCorreo',
            'buscarTelefono',
            'buscarDireccion',
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.admin.empresas.index', [
            'empresas' => Empresa::select('id', 'empresa', 'razon_social', 'ruc', 'correo', 'direccion', 'telefono')
                ->buscarEmpresa($this->buscarEmpresa)
                ->buscarRazonSocial($this->buscarRazonSocial)
                ->buscarRuc($this->buscarRuc)
                ->buscarCorreo($this->buscarCorreo)
                ->buscarDireccion($this->buscarDireccion)
                ->buscarTelefono($this->buscarTelefono)
                ->paginate($this->paginado)
        ]);
    }

    public function eliminar($id)
    {
        if (!$id) {
            return;
        }
        Empresa::findOrFail($id)->delete();
        session()->flash('success', 'Empresa Eliminada Correctamente!');
        $this->redirectRoute('admin.empresas.index');
    }
}
