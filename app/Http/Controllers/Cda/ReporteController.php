<?php

namespace App\Http\Controllers\Cda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function ingreso()
    {
        return view('cda.reportes.ingresos');    
    }
}
