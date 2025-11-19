<?php

namespace App\Livewire\Cda\Reportes;

use App\Models\Acceso;
use App\Models\Cda\IngresoVehiculo;
use App\Models\Cda\Persona;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Ingreso extends Component
{
    use WithPagination;

    // #[Url]
    public $buscarFechaHoraIngreso, $buscarVehiculoPorChapa = '', $buscarPersonaVisitoId = '', $buscarAccesoId = '';

    public $personasVisitables = [], $accesos = []; // PROPIEDADES PARA LOS SELECT

    public $paginado = 5;

    public function mount()
    {
        $this->buscarFechaHoraIngreso = Carbon::now()->toDateString();
        $this->personasVisitables = Persona::where('esPersonalEmpresa', true)
            ->orderBy('nombre_completo')
            ->get(['id', 'nombre_completo']);
        $this->accesos = Acceso::get(['id', 'acceso']);
    }

    public function render()
    {
        return view('livewire.cda.reportes.ingreso', [
            'ingresos' => IngresoVehiculo::select(
                'id',
                'fecha_hora_ingreso',
                'vehiculo_id',
                'persona_ingresa_id',
                'persona_visita_id',
                'acceso_ingreso_id',
                'usuario_registro_ingreso'
            )->buscarFechaHoraIngreso($this->buscarFechaHoraIngreso)
                ->buscarVehiculoPorChapa($this->buscarVehiculoPorChapa)
                ->buscarPersonaVisitoId($this->buscarPersonaVisitoId)
                ->buscarAccesoId($this->buscarAccesoId)
                ->with([
                    'vehiculo:id,chapa',
                    'personaIngreso:id,nombre_completo',
                    'personaVisito:id,nombre_completo',
                    'accesoIngreso:id,acceso',
                    'usuarioRegistroIngreso:id,name'
                ])->paginate($this->paginado)
        ]);
    }
}
