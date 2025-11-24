<?php

namespace App\Livewire\Admin\Empresas;

use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public $registro;
    #[Validate]
    public $id, $empresa, $razon_social, $ruc, $correo, $direccion, $telefono;

    public function mount($empresa)
    {
        $this->registro     = $empresa;
        $this->id           = $empresa->id;
        $this->empresa      = $empresa->empresa;
        $this->razon_social = $empresa->razon_social;
        $this->ruc          = $empresa->ruc;
        $this->correo       = $empresa->correo;
        $this->direccion    = $empresa->direccion;
        $this->telefono     = $empresa->telefono;
    }

    protected function rules()
    {
        return [
            'empresa'         => ['required', 'string', 'max:50', Rule::unique(Empresa::class)->ignore($this->id)],
            'razon_social'    => ['required', 'string', 'max:75', Rule::unique(Empresa::class)->ignore($this->id)],
            'ruc'             => ['required', 'string', 'max:15', Rule::unique(Empresa::class)->ignore($this->id)],
            'correo'          => ['required', 'email',  'max:50', Rule::unique(Empresa::class)->ignore($this->id)],
            'direccion'       => ['required', 'string', 'max:100'],
            'telefono'        => ['required', 'string', 'max:20', Rule::unique(Empresa::class)->ignore($this->id)],
        ];
    }

    public function guardar()
    {
        $this->validate();
        Empresa::findOrFail($this->id)->update([
            'empresa'         => $this->empresa,
            'razon_social'    => $this->razon_social,
            'ruc'             => $this->ruc,
            'correo'          => $this->correo,
            'direccion'       => $this->direccion,
            'telefono'        => $this->telefono,
            'actualizado_por' => Auth::id(),
        ]);
        session()->flash('success', 'Empresa Actualizada Correctamente!');
        $this->redirectRoute('admin.empresas.index');
    }

    public function render()
    {
        return view('livewire.admin.empresas.edit');
    }
}
