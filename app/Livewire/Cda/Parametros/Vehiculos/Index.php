<?php

namespace App\Livewire\Cda\Parametros\Vehiculos;

use App\Models\Cda\Color;
use App\Models\Cda\Marca;
use App\Models\Cda\Modelo;
use App\Models\Cda\Vehiculo;
use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    /*
    |---------------------------------------
    | Componente que renderiza tabla de vehiculos
    |---------------------------------------
    */

    use WithPagination;

    # PROPIEDADES DE BUSQUEDA Y PAGINACION
    public $buscarChapa = '', $buscarNroMovil = '', $buscarMarcaId = '', $buscarModeloId = '', $buscarColorId = '', $buscarEmpresaId = '';
    public $paginado = 5;

    # PROPIEDADES PARA LOS SELECT
    public $marcas = [], $modelos = [], $colores = [], $empresas = [];

    # FUNCION MOUNT DE LIVEWIRE
    public function mount()
    {
        $this->marcas   = Marca::get(['id', 'marca']);
        $this->modelos  = Modelo::get(['id', 'modelo']);
        $this->colores  = Color::get(['id', 'color']);
        $this->empresas = Empresa::get(['id', 'empresa']);
    }

    # LIMPIAR EL BUSCADOR Y LA PAGINACION AL CAMBIAR DE PAGINA
    public function updating($key): void
    {
        if (in_array($key, [
            'buscarChapa',
            'buscarNroMovil',
            'buscarMarcaId',
            'buscarModeloId',
            'buscarColorId',
            'buscarEmpresaId',
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.cda.parametros.vehiculos.index', [
            'vehiculos' => Vehiculo::select('id', 'chapa', 'nro_movil', 'marca_id', 'modelo_id', 'color_id', 'empresa_id')
                ->buscarChapa($this->buscarChapa)
                ->buscarNroMovil($this->buscarNroMovil)
                ->buscarMarcaId($this->buscarMarcaId)
                ->buscarModeloId($this->buscarModeloId)
                ->buscarColorId($this->buscarColorId)
                ->buscarEmpresaId($this->buscarEmpresaId)
                ->with(['marca:id,marca', 'modelo:id,modelo', 'color:id,color', 'empresa:id,empresa'])
                ->paginate($this->paginado)
        ]);
    }

    # Eliminar Vehiculo
    public function eliminar($id = null)
    {
        try {
            Vehiculo::findOrFail($id)->delete();

            session()->flash('success', 'Vehiculo Eliminado Correctamente!');
        } catch (\Exception $e) {
            session()->flash('error', 'No se pudo eliminar el Vehiculo. ' . $e->getMessage());
        }

        return $this->redirectRoute('cda.parametros.vehiculos.index');
    }

    # Actualizar Modelos Del select de filtros al cambiar de Marca
    public function updatedBuscarMarcaId($marca_id)
    {
        $this->modelos = Modelo::where('marca_id', $marca_id)->get(['id', 'modelo']);
    }
}
