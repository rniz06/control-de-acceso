<?php

namespace App\Livewire\Cda\Parametros\Vehiculos;

use App\Models\Cda\Color;
use App\Models\Cda\Marca;
use App\Models\Cda\Modelo;
use App\Models\Cda\Vehiculo;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalEdit extends Component
{
    /*
    |---------------------------------------------------------
    | Componente modal con formulario de edicion de vehiculos
    |---------------------------------------------------------
    */

    # PROPIEDAD PARA ALMACENAR EL REGISTRO A EDITAR
    public $vehiculo;

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $chapa, $marca_id, $modelo_id, $color_id, $nro_movil, $empresa_id;

    # PROPIEDAD PARA LOS SELECT
    public $marcas = [], $modelos = [], $colores = [], $empresas = [];

    # FUNCION MOUNT DE LIVEWIRE
    public function mount($vehiculo_id)
    {
        $this->vehiculo  = Vehiculo::findOrFail($vehiculo_id);
        $this->chapa     = $this->vehiculo->chapa;
        $this->nro_movil = $this->vehiculo->nro_movil;
        $this->marca_id  = $this->vehiculo->marca_id;
        $this->modelo_id = $this->vehiculo->modelo_id;
        $this->color_id  = $this->vehiculo->color_id;
        $this->empresa_id = $this->vehiculo->empresa_id;

        $this->marcas    = Marca::get(['id', 'marca']);
        $this->modelos   = Modelo::where('marca_id', $this->marca_id)->get(['id', 'modelo']);
        $this->colores   = Color::get(['id', 'color']);
        $this->empresas  = Empresa::get(['id', 'empresa']);
    }

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'chapa'       => ['required', 'string', 'min:6', 'max:7', Rule::unique(Vehiculo::class, 'chapa')->ignore($this->vehiculo->id, 'id')],
            'nro_movil'   => [
                'nullable',
                'string',
                'min_digits:1',
                'max_digits:5',
                Rule::unique(Vehiculo::class, 'nro_movil')->where('empresa_id', $this->empresa_id)->ignore($this->vehiculo->id, 'id')
            ],
            'marca_id'    => ['required', Rule::exists(Marca::class, 'id')],
            'modelo_id'   => ['required', Rule::exists(Modelo::class, 'id')],
            'color_id'    => ['required', Rule::exists(Color::class, 'id')],
            'empresa_id'  => ['required', Rule::exists(Empresa::class, 'id')],
        ];
    }

    # PERSONALIZAR MENSAJES DE VALIDACION
    protected function messages()
    {
        return [
            'nro_movil.unique' => 'ESTE NRO. DE MOVIL YA SE REGISTRO EN ESTA EMPRESA.'
        ];
    }

    # FUNCION PARA GUARDAR EL NUEVO VEHICULO
    public function grabar()
    {
        $this->validate();
        $this->vehiculo->update([
            'chapa'            => $this->chapa,
            'nro_movil'        => $this->nro_movil,
            'marca_id'         => $this->marca_id,
            'modelo_id'        => $this->modelo_id,
            'color_id'         => $this->color_id,
            'empresa_id'       => $this->empresa_id,
            'actualizado_por'  => Auth::id(),
        ]);

        session()->flash('success', 'vehiculo Actualizado Correctamente!');
        $this->redirectRoute('cda.parametros.vehiculos.index');
    }

    public function updatedMarcaId($marca_id)
    {
        $this->modelo_id = null;
        $this->modelos = Modelo::where('marca_id', $marca_id)->get(['id', 'modelo']);
    }

    public function render()
    {
        return view('livewire.cda.parametros.vehiculos.modal-edit');
    }

}
