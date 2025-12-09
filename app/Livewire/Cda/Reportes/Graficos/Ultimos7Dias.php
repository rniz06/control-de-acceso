<?php

namespace App\Livewire\Cda\Reportes\Graficos;

use App\Models\Cda\IngresoVehiculo;
use Carbon\Carbon;
use Livewire\Component;

class Ultimos7Dias extends Component
{
    public $labels = [];
    public $dataIngresos = [];
    public $dataSalidas = [];

    public function mount()
    {
        $this->generarDatos();
    }

    public function generarDatos()
    {
        // Últimos 7 días (de hoy hacia atrás)
        for ($i = 6; $i >= 0; $i--) {
            $dia = Carbon::today()->subDays($i);

            // Etiqueta corta: 02/12
            $this->labels[] = $dia->dayName . '  ' . $dia->format('d/m');

            // INGRESOS de ese día
            $ingresos = IngresoVehiculo::whereDate('fecha_hora_ingreso', $dia)
                ->where('corresponde_salida', false)
                ->count();

            // SALIDAS de ese día
            $salidas = IngresoVehiculo::whereDate('fecha_hora_salida', $dia)
                ->where('corresponde_salida', true)
                ->count();

            $this->dataIngresos[] = $ingresos;
            $this->dataSalidas[] = $salidas;
        }
    }

    public function render()
    {
        return view('livewire.cda.reportes.graficos.ultimos7-dias', [
            'labels' => $this->labels,
            'ingresos' => $this->dataIngresos,
            'salidas' => $this->dataSalidas
        ]);
    }
}
