<?php

namespace App\Livewire\Cda\Parametros\Marcas;

use App\Models\Cda\Marca;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalCreate extends Component
{
    /*
    |---------------------------------------
    | Componente modal con formulario de alta de marca
    |---------------------------------------
    */

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $marca;

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'marca' => ['required', 'string', 'max:30', Rule::unique(Marca::class, 'marca')]
        ];
    }

    # FUNCION PARA GUARDAR UNA NUEVA MARCA
    public function grabar()
    {
        $this->validate();
        Marca::create([
            'marca'       => $this->marca,
            'creado_por'  => Auth::id(),
        ]);

        session()->flash('success', 'Marca Registrada Correctamente!');
        $this->redirectRoute('cda.parametros.marcas.index');
    }

    public function render()
    {
        return view('livewire.cda.parametros.marcas.modal-create');
    }
}
