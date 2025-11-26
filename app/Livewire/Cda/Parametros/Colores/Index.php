<?php

namespace App\Livewire\Cda\Parametros\Colores;

use App\Models\Cda\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    /*
    |---------------------------------------
    | Componente que renderiza tabla de colores
    |---------------------------------------
    */

    use WithPagination;

    # PROPIEDADES DE BUSQUEDA Y PAGINACION
    public $buscarColor = '';
    public $paginado = 5;

    # LIMPIAR EL BUSCADOR Y LA PAGINACION AL CAMBIAR DE PAGINA
    public function updating($key): void
    {
        if (in_array($key, [
            'buscarColor',
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.cda.parametros.colores.index', [
            'colores' => Color::select('id', 'color')
                ->buscarColor($this->buscarColor)
                ->orderBy('color')
                ->paginate($this->paginado)
        ]);
    }

    # Eliminar Color
    public function eliminar($id = null)
    {
        try {
            Color::findOrFail($id)->delete();

            session()->flash('success', 'Color Eliminado Correctamente!');
        } catch (\Exception $e) {
            session()->flash('error', 'No se pudo eliminar el Color');
        }

        return $this->redirectRoute('cda.parametros.colores.index');
    }
}
