<?php

namespace App\Livewire\Empresas\Sucursales;

use App\Models\Empresa;
use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithPagination;

class ModalVerSucursales extends Component
{
    use WithPagination;

    public $empresa, $paginado = 5;

    public function mount($empresa_id)
    {
        $this->empresa = Empresa::findOrFail($empresa_id);
    }

    // Limpiar el buscador y la paginación al cambiar de pagina
    public function updating($key): void
    {
        if (in_array($key, [
            'paginado',
        ])) {
            $this->resetPage('sucursales_page');
        }
    }

    public function render()
    {
        return view(
            'livewire.empresas.sucursales.modal-ver-sucursales',
            [
                'sucursales' => Sucursal::where('empresa_id', $this->empresa->id)->paginate($this->paginado, ['*'], 'sucursales_page')
            ]
        );
    }
}
