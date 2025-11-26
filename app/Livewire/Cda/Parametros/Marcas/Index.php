<?php

namespace App\Livewire\Cda\Parametros\Marcas;

use App\Models\Cda\Marca;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    /*
    |---------------------------------------
    | Componente que renderiza tabla de marcas
    |---------------------------------------
    */

    use WithPagination;

    # PROPIEDADES DE BUSQUEDA Y PAGINACION
    public $buscarMarca = '';
    public $paginado = 5;

    # LIMPIAR EL BUSCADOR Y LA PAGINACION AL CAMBIAR DE PAGINA
    public function updating($key): void
    {
        if (in_array($key, [
            'buscarMarca',
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.cda.parametros.marcas.index', [
            'marcas' => Marca::select('id', 'marca')
                ->buscarMarca($this->buscarMarca)
                ->orderBy('marca')
                ->paginate($this->paginado)
        ]);
    }

    # Eliminar Marca
    public function eliminar($id = null)
    {
        try {
            Marca::findOrFail($id)->delete();

            session()->flash('success', 'Marca Eliminada Correctamente!');
        } catch (\Exception $e) {
            session()->flash('error', 'No se pudo eliminar la Marca');
        }

        return $this->redirectRoute('cda.parametros.marcas.index');
    }
}
