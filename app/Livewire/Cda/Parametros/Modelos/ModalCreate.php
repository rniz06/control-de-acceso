<?php

namespace App\Livewire\Cda\Parametros\Modelos;

use App\Models\Cda\Marca;
use App\Models\Cda\Modelo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalCreate extends Component
{
    /*
    |---------------------------------------
    | Componente modal con formulario de alta de modelo
    |---------------------------------------
    */

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $modelo, $marca_id;

    # PROPIEDADES PARA LOS SELECT
    public $marcas = [];

    # FUNCION MOUNT DE LIVEWIRE
    public function mount()
    {
        $this->marcas  = Marca::get(['id', 'marca']);
    }

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'modelo'   => ['required', 'string', 'max:30', Rule::unique(Modelo::class, 'modelo')->where('marca_id', $this->marca_id)],
            'marca_id' => ['required', Rule::exists(Marca::class, 'id')]
        ];
    }

    # FUNCION PARA GUARDAR UNA NUEVA MARCA
    public function grabar()
    {
        $this->validate();
        Modelo::create([
            'modelo'       => $this->modelo,
            'marca_id'     => $this->marca_id,
            'creado_por'   => Auth::id(),
        ]);

        session()->flash('success', 'Modelo Registrado Correctamente!');
        $this->redirectRoute('cda.parametros.modelos.index');
    }

    public function render()
    {
        return view('livewire.cda.parametros.modelos.modal-create');
    }
}
