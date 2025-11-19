<?php

namespace App\Livewire\Cda;

use Livewire\Component;

class PanelCentral extends Component
{
    public function ingresoVehiculo()
    {
        $this->redirectRoute('cda.ingreso-vehiculo.ingreso');    
    }

    public function ingresoPersona()
    {
        $this->redirectRoute('cda.ingreso-persona.ingreso');    
    }

    public function salidaVehiculo()
    {
        $this->redirectRoute('cda.ingreso-vehiculo.salida');    
    }

    public function salidaPersona()
    {
        $this->redirectRoute('cda.ingreso-persona.salida');    
    }

    public function render()
    {
        return view('livewire.cda.panel-central');
    }
}
