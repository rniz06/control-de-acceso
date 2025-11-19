<?php

namespace App\Livewire\Cda\IngresoPersona;

use App\Models\Acceso;
use App\Models\Cda\IngresoPersona;
use App\Models\Cda\Persona;
use App\Services\Cda\Validaciones\IngresoPersonaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Ingreso extends Component
{
    // Datos del ingreso
    public $persona_ingresa_id, $persona_visita_id, $acceso_ingreso_id;

    // Datos de la persona que ingresa
    public $nombre_completo, $nro_cedula;

    // Bloqueo de formulario
    public $bloqueoFormPerIngresa = true;

    // Opciones para selects
    public $personasVisitables, $accesos;

    public function mount()
    {
        $this->personasVisitables = Persona::where('esPersonalEmpresa', true)
            ->orderBy('nombre_completo')
            ->get(['id', 'nombre_completo']);
        $this->accesos = Acceso::orderBy('acceso')->get(['id', 'acceso']);
    }

    protected function rules()
    {
        return [
            'nro_cedula'       => ['required', 'string', 'min:6', 'max:15'],
            'nombre_completo'  => ['required', 'string'],
            'persona_visita_id'   => ['required', Rule::exists(Persona::class, 'id')],
            'acceso_ingreso_id'   => ['required', Rule::exists(Acceso::class, 'id')],
        ];
    }

    /** ─────────────────────────────────────────────
     *  Eventos de actualización
     * ────────────────────────────────────────────── */

    public function updatedNroCedula($value)
    {
        # VALIDAR SI EL VEHICULO INGRESO ANTERIORMEMTE Y REGISTRO SALIDA, SINO LANZAR ALERTA
        if (IngresoPersonaService::tieneSalidaPendiente($this->nro_cedula)) {
            $this->addError('nro_cedula', 'Persona registra un ingreso sin salida registrada.');
            return;
        }
        
        $this->resetPersonaForm();

        $persona = Persona::select('id', 'nombre_completo', 'nro_cedula')
            ->where('nro_cedula', $value)
            ->first();

        if ($persona) {
            $this->fillPersona($persona);
        } else {
            $this->bloqueoFormPerIngresa = false;
        }
    }

    /** ─────────────────────────────────────────────
     *  Métodos auxiliares (limpieza y relleno)
     * ────────────────────────────────────────────── */
    private function resetPersonaForm()
    {
        $this->bloqueoFormPerIngresa = true;
        $this->nombre_completo = '';
        $this->persona_ingresa_id = null;
    }

    private function fillPersona($persona)
    {
        $this->nombre_completo = $persona->nombre_completo;
        $this->persona_ingresa_id = $persona->id;
    }

    /** ────────────────────────────────────────────
     *  Registro de ingreso
     * ────────────────────────────────────────────── */
    public function grabar()
    {
        $this->validate();

        DB::transaction(function () {

            $this->persona_ingresa_id = $this->persona_ingresa_id ?: Persona::create([
                'nombre_completo'   => $this->nombre_completo,
                'nro_cedula'        => $this->nro_cedula,
                'esPersonalEmpresa' => false,
                'creado_por'        => Auth::id(),
            ])->id;

            IngresoPersona::create([
                'fecha_hora_ingreso'       => now(),
                'persona_ingresa_id'       => $this->persona_ingresa_id,
                'persona_visita_id'        => $this->persona_visita_id,
                'acceso_ingreso_id'        => $this->acceso_ingreso_id,
                'usuario_registro_ingreso' => Auth::id(),
                'creado_por'               => Auth::id(),
            ]);
        });



        session()->flash('success', 'Ingreso registrado correctamente.');
        return redirect()->route('cda.panel-central.index');
    }

    public function render()
    {
        return view('livewire.cda.ingreso-persona.ingreso');
    }
}
