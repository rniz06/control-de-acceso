<?php

namespace App\Http\Controllers\Cda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControlDeAccesoController extends Controller
{
    public function ingresoVehiculo()
    {
        return view('cda.ingreso-vehiculo.ingreso-vehiculo');    
    }

    public function salidaVehiculo()
    {
        return view('cda.ingreso-vehiculo.salida-vehiculo');    
    }

    public function ingresoPersona()
    {
        return view('cda.ingreso-persona.ingreso-persona');    
    }

    public function salidaPersona()
    {
        return view('cda.ingreso-persona.salida-persona');    
    }
}
