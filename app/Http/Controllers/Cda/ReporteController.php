<?php

namespace App\Http\Controllers\Cda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Establece los middleware necesarios para gestionar permisos
     * Se utilizan permisos específicos para cada acción del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:Reportes Ingresos Listar', ['only' => ['ingreso']]);
        $this->middleware('permission:Reportes Salidas Listar', ['only' => ['salidas']]);
        $this->middleware('permission:Reportes Graficos', ['only' => ['salidas']]);
    }

    public function ingreso()
    {
        return view('cda.reportes.ingresos');    
    }

    public function salidas()
    {
        return view('cda.reportes.salidas');    
    }

    public function graficos()
    {
        return view('cda.reportes.graficos');    
    }
}
