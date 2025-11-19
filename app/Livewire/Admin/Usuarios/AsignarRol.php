<?php

namespace App\Livewire\Admin\Usuarios;

use App\Models\Admin\Rol;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AsignarRol extends Component
{
    public $usuario; // ID DEL USUARIO RECIBIDO POR PARAMETRO

    #[Validate]
    public $roles = [];

    public $rolesParaSelect = []; // PROPIEDADES PARA SELECT

    public function mount($id)
    {
        $this->usuario = User::findOrFail($id);
        $this->rolesParaSelect = Rol::select('name')->whereNotLike('name', 'SuperAdmin')->get();
        $this->roles = $this->usuario->getRoleNames();
    }

    protected function rules()
    {
        return [
            'roles'    => ['nullable', 'array']
        ];
    }

    public function guardar()
    {
        $this->validate();
        // ASIGNAR LOS ROLES SELECCIONADOS AL USUARIO
        $this->usuario->syncRoles($this->roles);

        session()->flash('success', 'Roles Asignados Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }
    
    public function render()
    {
        return view('livewire.admin.usuarios.asignar-rol');
    }
}
