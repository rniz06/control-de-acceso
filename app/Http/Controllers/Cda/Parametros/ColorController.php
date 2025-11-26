<?php

namespace App\Http\Controllers\Cda\Parametros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Establece los middleware necesarios para gestionar permisos
     * Se utilizan permisos específicos para cada acción del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:Colores Listar', ['only' => ['index']]);
    }

    public function index()
    {
        return view('cda.parametros.colores.index');    
    }
}
