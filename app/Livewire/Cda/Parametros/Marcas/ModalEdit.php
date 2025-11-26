<?php

namespace App\Livewire\Cda\Parametros\Marcas;

use App\Models\Cda\Marca;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalEdit extends Component
{
    /*
    |---------------------------------------------------------
    | Componente modal con formulario de edicion de marca
    |---------------------------------------------------------
    */

    # PROPIEDAD PARA ALMACENAR EL REGISTRO A EDITAR
    public $registro;

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $marca;

    # FUNCION MOUNT DE LIVEWIRE
    public function mount($marca_id)
    {
        $this->registro  = Marca::findOrFail($marca_id);

        $this->marca = $this->registro->marca;
    }

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'marca' => ['required', 'string', 'max:30', Rule::unique(Marca::class, 'marca')->ignore($this->registro->id, 'id')],
        ];
    }

    # FUNCION PARA GUARDAR EL NUEVO VEHICULO
    public function grabar()
    {
        $this->validate();
        $this->registro->update([
            'marca'            => $this->marca,
            'actualizado_por'  => Auth::id(),
        ]);

        session()->flash('success', 'Marca Actualizada Correctamente!');
        $this->redirectRoute('cda.parametros.marcas.index');
    }

    public function render()
    {
        return view('livewire.cda.parametros.marcas.modal-edit');
    }

}
