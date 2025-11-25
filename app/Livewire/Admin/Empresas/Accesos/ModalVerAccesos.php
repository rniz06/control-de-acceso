<?php

namespace App\Livewire\Admin\Empresas\Accesos;

use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithPagination;

class ModalVerAccesos extends Component
{
    /*
    |---------------------------------------
    | Componente renderizada modal con listado de accesos de una empresa
    |---------------------------------------
    */

    use WithPagination;

    # PROPIEDADES DE LA EMPRESA PADRE Y PAGINACION
    public $empresa, $paginado = 5;

    public function mount($empresa_id)
    {
        $this->empresa = Empresa::findOrFail($empresa_id);
    }

    # LIMPIAR EL BUSCADOR Y LA PAGINACION AL CAMBIAR DE PAGINA
    public function updating($key): void
    {
        if (in_array($key, [
            'paginado',
        ])) {
            $this->resetPage('accesos_page');
        }
    }

    public function render()
    {
        return view('livewire.admin.empresas.accesos.modal-ver-accesos', [
            'accesos' => $this->empresa->accesos()->paginate($this->paginado, ['*'], 'accesos_page')
        ]);
    }

    # Resetea la paginacion al cerrar el modal para evitar errores al abrir otro modal
    public function cerrar_modal()
    {
        $this->resetPage('accesos_page');
    }
}
