<?php

namespace App\Livewire\Cda\Parametros\Colores;

use App\Models\Cda\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalEdit extends Component
{

    /*
    |---------------------------------------------------------
    | Componente modal con formulario de edicion de color
    |---------------------------------------------------------
    */

    # PROPIEDAD PARA ALMACENAR EL REGISTRO A EDITAR
    public $registro;

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $color;

    # FUNCION MOUNT DE LIVEWIRE
    public function mount($color_id)
    {
        $this->registro  = Color::findOrFail($color_id);

        $this->color = $this->registro->color;
    }

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'color' => ['required', 'string', 'max:30', Rule::unique(Color::class, 'color')->ignore($this->registro->id, 'id')],
        ];
    }

    # FUNCION PARA ACTUALIZAR EL REGISTRO
    public function grabar()
    {
        $this->validate();
        $this->registro->update([
            'color'            => $this->color,
            'actualizado_por'  => Auth::id(),
        ]);

        session()->flash('success', 'Color Actualizado Correctamente!');
        $this->redirectRoute('cda.parametros.colores.index');
    }

    public function render()
    {
        return view('livewire.cda.parametros.colores.modal-edit');
    }
}
