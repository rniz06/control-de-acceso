<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Establece los middleware necesarios para gestionar permisos
     * Se utilizan permisos específicos para cada acción del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:Roles Listar', ['only' => ['index']]);
        $this->middleware('permission:Roles Crear', ['only' => ['create']]);
        $this->middleware('permission:Roles Editar', ['only' => ['edit']]);
    }

    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function edit($role)
    {
        return view('admin.roles.edit', compact('role'));
    }
}
