<?php

namespace App\Http\Controllers\Cda\Parametros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Establece los middleware necesarios para gestionar permisos
     * Se utilizan permisos específicos para cada acción del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:Modelos Listar', ['only' => ['index']]);
    }

    public function index()
    {
        return view('cda.parametros.modelos.index');    
    }
}
