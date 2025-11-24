<?php

namespace App\Livewire\Admin\Empresas;

use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $empresa, $razon_social, $ruc, $correo, $direccion, $telefono;

    protected function rules()
    {
        return [
            'empresa'         => ['required', 'string', 'max:50', Rule::unique(Empresa::class)],
            'razon_social'    => ['required', 'string', 'max:75', Rule::unique(Empresa::class)],
            'ruc'             => ['required', 'string', 'max:15', Rule::unique(Empresa::class)],
            'correo'          => ['required', 'email',  'max:50', Rule::unique(Empresa::class)],
            'direccion'       => ['required', 'string', 'max:100'],
            'telefono'        => ['required', 'string', 'max:20', Rule::unique(Empresa::class)],
        ];
    }

    public function guardar()
    {
        $this->validate();
        Empresa::create([
            'empresa'       => $this->empresa,
            'razon_social'  => $this->razon_social,
            'ruc'           => $this->ruc,
            'correo'        => $this->correo,
            'direccion'     => $this->direccion,
            'telefono'      => $this->telefono,
            'creado_por'    => Auth::id(),
        ]);

        session()->flash('success', 'Empresa Creada Correctamente!');
        $this->redirectRoute('admin.empresas.index');
    }

    public function render()
    {
        return view('livewire.admin.empresas.create');
    }
}
