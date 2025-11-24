<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Establece los middleware necesarios para gestionar permisos
     * Se utilizan permisos específicos para cada acción del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:Empresas Listar', ['only' => ['index']]);
        $this->middleware('permission:Empresas Crear', ['only' => ['create']]);
        $this->middleware('permission:Empresas Editar', ['only' => ['edit']]);
    }

    public function index()
    {
        return view('admin.empresas.index');    
    }

    public function create()
    {
        return view('admin.empresas.create');    
    }

    public function edit(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));    
    }
}
