<?php

namespace App\Livewire\Admin\Usuarios;

use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public $id;
    #[Validate]
    public $name, $usuario, $nro_cedula, $nro_celular, $observacion, $email, $empresa_id, $sucursal_id, $departamento_id;

    public $empresas = [], $sucursales = [], $departamentos = []; // PROPIEDADES PARA SELECT

    public function mount(User $user)
    {
        $this->id              = $user->id;
        $this->name            = $user->name;
        $this->usuario         = $user->usuario;
        $this->email           = $user->email;
        $this->nro_cedula      = $user->nro_cedula;
        $this->nro_celular     = $user->nro_celular;
        $this->observacion     = $user->observacion;
        $this->empresa_id      = $user->empresa_id;
        $this->sucursal_id     = $user->sucursal_id;
        $this->departamento_id = $user->departamento_id;

        $this->empresas      = Empresa::select('id', 'empresa')->orderBy('empresa')->get();
        $this->sucursales    = Sucursal::select('id', 'sucursal')->orderBy('sucursal')->get();
        $this->departamentos = Departamento::select('id', 'departamento')->orderBy('departamento')->get();
    }

    protected function rules()
    {
        return [
            'name'            => ['required', 'string', 'max:100'],
            'usuario'         => ['required', 'string', 'max:45', Rule::unique(User::class)->ignore($this->id)],
            'email'           => ['nullable', 'email', 'max:100', Rule::unique(User::class)->ignore($this->id)],
            'nro_cedula'      => ['required', 'string', 'max:45', Rule::unique(User::class)->ignore($this->id)],
            'nro_celular'     => ['required', 'string', 'max:45', Rule::unique(User::class)->ignore($this->id)],
            'observacion'     => ['required', 'string', 'max:255'],
            'empresa_id'      => ['required', Rule::exists(Empresa::class, 'id')],
            'sucursal_id'     => ['required', Rule::exists(Sucursal::class, 'id')],
            'departamento_id' => ['required', Rule::exists(Departamento::class, 'id')],
        ];
    }

    public function guardar()
    {
        $this->validate();
        User::findOrFail($this->id)->update([
            'name' => $this->name,
            'usuario' => $this->usuario,
            'email' => $this->email,
            'nro_cedula' => $this->nro_cedula,
            'nro_celular' => $this->nro_celular,
            'observacion' => $this->observacion,
            'empresa_id'      => $this->empresa_id,
            'sucursal_id'     => $this->sucursal_id,
            'departamento_id' => $this->departamento_id,
            'actualizado_por' => Auth::id(),
        ]);

        session()->flash('success', 'Usuario Actualizado Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    public function render()
    {
        return view('livewire.admin.usuarios.edit');
    }
}
