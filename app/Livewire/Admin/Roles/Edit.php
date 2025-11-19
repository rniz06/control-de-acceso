<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Admin\Permiso;
use App\Models\Admin\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public $id;

    #[Validate]
    public $name, $permisos; // PROPIEDADES DEL FORMULARIO

    public $permisosParaSelect = []; // PROPIEDADES PARA SELECT(CHECKBOX)

    public function mount()
    {
        $rol = Rol::findOrFail($this->id);
        $this->name = $rol->name;
        $this->permisos = $rol->permissions->pluck('name')->toArray();
        $this->permisosParaSelect = Permiso::select('name')->where('name', 'NOT LIKE', 'SuperAdmin')->get();
    }

    protected function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:45', Rule::unique(Rol::class)->ignore($this->id)],
            'permisos'    => ['required', 'array']
        ];
    }

    public function guardar()
    {
        $this->validate();
        $rol = Rol::findOrFail($this->id);
        $rol->update([
            'name' => $this->name,
            'actualizadoPor' => Auth::id(),
        ]);
        // ASIGNAR LOS PERMISOS SELECCIONADOS AL ROL
        $rol->syncPermissions($this->permisos);

        session()->flash('success', 'Rol Actualizado Correctamente!');
        $this->redirectRoute('admin.roles.index');
    }

    public function render()
    {
        return view('livewire.admin.roles.edit');
    }
}
