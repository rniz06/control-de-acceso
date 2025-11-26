<?php

namespace App\Livewire\Cda\Parametros\Colores;

use App\Models\Cda\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalCreate extends Component
{
    /*
    |-------------------------------------------------
    | Componente modal con formulario de alta de color
    |-------------------------------------------------
    */

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $color;

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'color' => ['required', 'string', 'max:30', Rule::unique(Color::class, 'color')]
        ];
    }

    # FUNCION PARA GUARDAR UN NUEVO COLOR
    public function grabar()
    {
        $this->validate();
        Color::create([
            'color'       => $this->color,
            'creado_por'  => Auth::id(),
        ]);

        session()->flash('success', 'Color Registrada Correctamente!');
        $this->redirectRoute('cda.parametros.colores.index');
    }

    public function render()
    {
        return view('livewire.cda.parametros.colores.modal-create');
    }
}
