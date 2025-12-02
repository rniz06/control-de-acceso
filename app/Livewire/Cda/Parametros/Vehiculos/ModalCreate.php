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

class ModalCreate extends Component
{
    /*
    |---------------------------------------
    | Componente modal con formulario de alta de vehiculos
    |---------------------------------------
    */

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $chapa, $nro_movil, $marca_id, $modelo_id, $color_id, $empresa_id = 2;

    # PROPIEDAD PARA LOS SELECT
    public $marcas = [], $modelos = [], $colores = [], $empresas = [];

    # FUNCION MOUNT DE LIVEWIRE
    public function mount()
    {
        $this->marcas   = Marca::get(['id', 'marca']);
        $this->colores  = Color::get(['id', 'color']);
        $this->empresas = Empresa::get(['id', 'empresa']);
    }

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'chapa'       => ['required', 'string', 'min:6', 'max:7', Rule::unique(Vehiculo::class, 'chapa')],
            'nro_movil'   => [
                'nullable',
                'string',
                'min_digits:1',
                'max_digits:5',
                Rule::unique(Vehiculo::class, 'nro_movil')->where('empresa_id', $this->empresa_id)
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
        Vehiculo::create([
            'chapa'       => $this->chapa,
            'nro_movil'   => $this->nro_movil,
            'marca_id'    => $this->marca_id,
            'modelo_id'   => $this->modelo_id,
            'color_id'    => $this->color_id,
            'empresa_id'  => $this->empresa_id,
            'creado_por'  => Auth::id(),
        ]);

        session()->flash('success', 'vehiculo Registrado Correctamente!');
        $this->redirectRoute('cda.parametros.vehiculos.index');
    }

    # AL ACTUALIZAR MARCA
    public function updatedMarcaId($marca_id)
    {
        $this->modelos = Modelo::where('marca_id', $marca_id)->get(['id', 'modelo']);
    }

    # FUNCION RENDER DE LIVEWIRE
    public function render()
    {
        return view('livewire.cda.parametros.vehiculos.modal-create');
    }

    # RESETEAR VALORES DEL FORM AL CERRAR EL MODAL CON BTN
    public function cerrar_modal()
    {
        $this->resetearForm();
        $this->resetValidation();
    }

    # RESETEAR CAMPOS DEL FORMULARIO
    private function resetearForm()
    {
        $this->chapa      = null;
        $this->nro_movil  = null;
        $this->marca_id   = null;
        $this->modelo_id  = null;
        $this->color_id   = null;
        $this->empresa_id = null;
    }
}
