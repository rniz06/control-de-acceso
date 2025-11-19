<?php

namespace App\Livewire\Cda\IngresoPersona;

use App\Models\Acceso;
use App\Models\Cda\IngresoPersona;
use App\Services\Cda\Validaciones\IngresoPersonaService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Salida extends Component
{
    public $registro;

    // Datos del ingreso
    public $nro_cedula, $acceso_salida_id;

    // Opciones para selects
    public $accesos;

    public function mount()
    {
        $this->accesos = Acceso::orderBy('acceso')->get(['id', 'acceso']);
    }

    protected function rules()
    {
        return [
            'nro_cedula'       => ['required', 'string', 'min:6', 'max:10'],
            'acceso_salida_id' => ['required', Rule::exists(Acceso::class, 'id')],
        ];
    }

    /** ─────────────────────────────────────────────
     *  Eventos de actualización
     * ────────────────────────────────────────────── */
    public function updatedNroCedula($value)
    {
        # VALIDACION SI NO SE ENCUENTRA UNA ENTRADA DE ESE VEHICULO
        if (IngresoPersonaService::intentaSalirSinIngreso($this->nro_cedula)) {
            $this->addError('nro_cedula', 'Persona No Registra Entrada.');
            return;
        }

        $this->resetPersonaForm();

        $this->registro = IngresoPersona::with(['personaIngreso'])
            ->whereHas('personaIngreso', function (Builder $query) use ($value) {
                $query->where('nro_cedula', $value);
            })->orderByDesc('created_at')->whereNull('fecha_hora_salida')->first();
    }

    /** ─────────────────────────────────────────────
     *  Métodos auxiliares (limpieza y relleno)
     * ────────────────────────────────────────────── */
    private function resetPersonaForm()
    {
        $this->registro = null;
    }

    /** ────────────────────────────────────────────
     *  Registro de ingreso
     * ────────────────────────────────────────────── */
    public function grabar()
    {
        
        $this->validate();

        // AGREGAR Y FILTRAR SOLO POR LOS PENDIENTES DE SALIDA
        
        $this->registro->update([
            'fecha_hora_salida'       => Carbon::now(),
            'acceso_salida_id'        => $this->acceso_salida_id,
            'usuario_registro_salida' => Auth::id(),
            'corresponde_salida'      => true,
            'actualizado_por'         => Auth::id(),
        ]);

        session()->flash('success', 'Salida registrada correctamente.');
        return redirect()->route('cda.panel-central.index');
    }

    public function render()
    {
        return view('livewire.cda.ingreso-persona.salida');
    }
}
