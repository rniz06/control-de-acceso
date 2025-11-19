<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Admin\Permiso;
use App\Models\Admin\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $name, $permisos; // PROPIEDADES DEL FORMULARIO

    public $permisosParaSelect = []; // PROPIEDADES PARA SELECT(CHECKBOX)

    public function mount()
    {
        $this->permisosParaSelect = Permiso::select('name')->where('name', 'NOT LIKE', 'SuperAdmin')->get();    
    }

    protected function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:45', Rule::unique(Rol::class)],
            'permisos'    => ['required', 'array']
        ];
    }

    public function guardar()
    {
        $this->validate();
        $rol = Rol::create([
            'name' => $this->name,
            'creadoPor' => Auth::id(),
        ]);
        // ASIGNAR LOS PERMISOS SELECCIONADOS AL ROL CREADO
        $rol->syncPermissions($this->permisos);

        session()->flash('success', 'Rol Creado Correctamente!');
        $this->redirectRoute('admin.roles.index');
    }

    public function render()
    {
        return view('livewire.admin.roles.create');
    }
}
