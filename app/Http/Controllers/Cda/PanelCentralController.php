<?php

namespace App\Http\Controllers\Cda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanelCentralController extends Controller
{
    public function index()
    {
        return view('cda.panel-central.index');    
    }
}
