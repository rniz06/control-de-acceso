<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Establece los middleware necesarios para gestionar permisos
     * Se utilizan permisos específicos para cada acción del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:Usuarios Listar', ['only' => ['index']]);
        $this->middleware('permission:Usuarios Crear', ['only' => ['create']]);
        $this->middleware('permission:Usuarios Editar', ['only' => ['edit']]);
        $this->middleware('permission:Usuarios Asignar Rol', ['only' => ['asignarRolAUsuario', 'asignarRol']]);
    }

    public function index()
    {
        return view('admin.usuarios.index');
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function asignarRolAUsuario()
    {
        return view('admin.usuarios.asignar-rol-a-usuarios');
    }

    public function edit($usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function asignarRol($usuario)
    {
        return view('admin.usuarios.asignar-rol', compact('usuario'));
    }

    public function cambiarContrasenha()
    {
        return view('admin.usuarios.cambiar-contrasenha');
    }
}
