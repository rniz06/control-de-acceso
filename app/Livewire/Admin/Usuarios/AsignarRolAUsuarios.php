<?php

namespace App\Livewire\Admin\Usuarios;

use App\Models\Admin\Rol;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AsignarRolAUsuarios extends Component
{
    #[Validate]
    public $rol, $usuarios = []; // PROPIEDADES DE FORMULARIO

    public $roles = [], $usuariosParaSelect = []; // PROPIEDADES PARA SELECT

    public function mount()
    {
        $this->roles = Rol::select('name')->whereNotLike('name', 'SuperAdmin')->get();
        $this->usuariosParaSelect = User::select('id', 'name')->whereNotLike('name', 'Administrador')->get();
    }

    protected function rules()
    {
        return [
            'rol'        => ['required', Rule::exists(Rol::class, 'name')],
            'usuarios'   => ['required', 'array', Rule::exists(User::class, 'id')]
        ];
    }

    public function guardar()
    {
        $this->validate();
        // Foreach
        foreach ($this->usuarios as $usuarioId) {
            $usuario = User::find($usuarioId);
            $usuario->assignRole($this->rol);
        }

        session()->flash('success', 'Usuario Creado Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    public function updatedRol($value)
    {
        $this->usuarios = User::role($value)
            ->whereNotLike('name', 'Administrador')
            ->pluck('id')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.admin.usuarios.asignar-rol-a-usuarios');
    }
}
