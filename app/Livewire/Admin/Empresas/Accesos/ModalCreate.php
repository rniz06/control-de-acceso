<?php

namespace App\Livewire\Admin\Empresas\Accesos;

use App\Models\Acceso;
use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalCreate extends Component
{
    /*
    |---------------------------------------
    | Componente modal con formulario de alta de acceso de una empresa
    |---------------------------------------
    */

    # PROPIEDAD PARA LA ALMACENAR LA EMPRESA PADRE Y SELECT DE SUCURSALES
    public $empresa, $sucursales = [];

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $acceso, $sucursal_id;

    # FUNCION MOUNT DE LIVEWIRE
    public function mount($empresa_id)
    {
        $this->empresa      = Empresa::findOrFail($empresa_id);
        $this->sucursales   = Sucursal::select('id', 'sucursal')->where('empresa_id', $this->empresa->id)->get();
    }

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'acceso'        => ['required', 'string', 'max:30'],
            'sucursal_id'    => ['required', Rule::exists(Sucursal::class, 'id')]
        ];
    }

    # FUNCION PARA GUARDAR EL NUEVO ACCESO
    public function grabar()
    {
        $this->validate();
        Acceso::create([
            'acceso'       => $this->acceso,
            'sucursal_id'  => $this->sucursal_id,
            'empresa_id'    => $this->empresa->id,
            'creado_por'    => Auth::id(),
        ]);

        session()->flash('success', 'Acceso Creado Correctamente!');
        $this->redirectRoute('admin.empresas.index');
    }

    public function render()
    {
        return view('livewire.admin.empresas.accesos.modal-create');
    }
}
