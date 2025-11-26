<?php

namespace App\Livewire\Cda\Parametros\Modelos;

use App\Models\Cda\Marca;
use App\Models\Cda\Modelo;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    /*
    |---------------------------------------
    | Componente que renderiza tabla de modelos
    |---------------------------------------
    */

    use WithPagination;

    # PROPIEDADES DE BUSQUEDA Y PAGINACION
    public $buscarModelo = '', $buscarMarcaId = '';
    public $paginado = 5;

    # PROPIEDADES PARA LOS SELECT DE BUSQUEDA
    public $marcas = [];

    # FUNCION MOUNT DE LIVEWIRE
    public function mount()
    {
        $this->marcas  = Marca::get(['id', 'marca']);
    }

    # LIMPIAR EL BUSCADOR Y LA PAGINACION AL CAMBIAR DE PAGINA
    public function updating($key): void
    {
        if (in_array($key, [
            'buscarModelo',
            'buscarMarcaId',
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.cda.parametros.modelos.index', [
            'modelos' => Modelo::select('id', 'modelo','marca_id')
                ->buscarModelo($this->buscarModelo)
                ->buscarMarcaId($this->buscarMarcaId)
                ->with(['marca:id,marca'])
                ->orderBy('modelo')
                ->paginate($this->paginado)
        ]);
    }

    # Eliminar Marca
    public function eliminar($id = null)
    {
        try {
            Modelo::findOrFail($id)->delete();

            session()->flash('success', 'Modelo Eliminado Correctamente!');
        } catch (\Exception $e) {
            session()->flash('error', 'No se pudo eliminar el Modelo');
        }

        return $this->redirectRoute('cda.parametros.modelos.index');
    }
}
