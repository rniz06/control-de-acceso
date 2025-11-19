<?php

namespace App\Livewire\Admin\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CambiarContrasenha extends Component
{
    # Componente para que el usuario cambie su contrasenha
    #[Validate]
    public $old_password, $new_password, $new_password_confirmation;


    protected function rules()
    {
        return [
            'old_password'              => ['required'],
            'new_password'              => ['required', 'string', 'min:8'],
            'new_password_confirmation' => ['same:new_password']
        ];
    }

    protected function messages()
    {
        return [
            'old_password.required' => 'El campo contraseña actual es obligatorio.',
            'new_password.required' => 'El campo nueva contraseña es obligatorio.',
            'new_password.min'      => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
        ];
    }

    public function grabar()
    {
        # 1. Aplicar las reglas de validacion
        $this->validate();

        # 2. Verificar la que coincida con el password actual
        if (!Hash::check($this->old_password, Auth::user()->password)) {
            $this->addError('old_password', 'La contraseña proporcionada no coincide con su contraseña real..');
            return;
        }

        # Actualizar contrasena en la tabla de users
        User::findOrFail(Auth::id())->update([
            'password' => $this->new_password
        ]);

        # Redireccionar Con mensaje de Correcto
        session()->flash('success', 'Contraseña Actualizada Correctamente!');
        return redirect()->route('admin.usuarios.cambiar-contrasenha');
    }

    public function render()
    {
        return view('livewire.admin.usuarios.cambiar-contrasenha');
    }
}
