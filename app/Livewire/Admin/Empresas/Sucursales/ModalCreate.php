<?php

namespace App\Livewire\Admin\Empresas\Sucursales;

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
    | Componente modal con formulario de alta de sucursal de una empresa
    |---------------------------------------
    */

    # PROPIEDAD PARA LA ALMACENAR LA EMPRESA PADRE
    public $empresa;

    # PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $sucursal, $razon_social, $ruc, $correo, $direccion, $telefono;

    public function mount($empresa_id)
    {
        $this->empresa      = Empresa::findOrFail($empresa_id);
        $this->razon_social = $this->empresa->razon_social;
        $this->ruc          = $this->empresa->ruc;
        $this->correo       = $this->empresa->correo;
        $this->direccion    = $this->empresa->direccion;
        $this->telefono     = $this->empresa->telefono;
    }

    # REGLAS DE VALIDACION
    protected function rules()
    {
        return [
            'sucursal'        => ['required', 'string', 'max:50', Rule::unique(Sucursal::class, 'sucursal')->where(fn(Builder $query) => $query->where('empresa_id', $this->empresa->id))],
            'razon_social'    => ['required', 'string', 'max:75'],
            'ruc'             => ['required', 'string', 'max:15'],
            'correo'          => ['required', 'email',  'max:50'],
            'direccion'       => ['required', 'string', 'max:100'],
            'telefono'        => ['required', 'string', 'max:20'],
        ];
    }

    # FUNCION PARA GUARDAR LA NUEVA SUCURSAL
    public function grabar()
    {
        $this->validate();
        Sucursal::create([
            'sucursal'       => $this->sucursal,
            'razon_social'  => $this->razon_social,
            'ruc'           => $this->ruc,
            'correo'        => $this->correo,
            'direccion'     => $this->direccion,
            'telefono'      => $this->telefono,
            'empresa_id'    => $this->empresa->id,
            'creado_por'    => Auth::id(),
        ]);

        session()->flash('success', 'Sucursal Creada Correctamente!');
        $this->redirectRoute('admin.empresas.index');
    }

    public function render()
    {
        return view('livewire.admin.empresas.sucursales.modal-create');
    }
}
