<?php

namespace App\Livewire\Cda\IngresoVehiculo;

use App\Models\Acceso;
use App\Models\Cda\IngresoVehiculo;
use App\Models\Cda\Persona;
use App\Models\Cda\Vehiculo;
use App\Services\Cda\Validaciones\IngresoVehiculoService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Salida extends Component
{
    use WithFileUploads;

    public $registro;

    // Datos del ingreso
    #[Validate]
    public $chapa, $acceso_salida_id = 1, $imagen;

    // Opciones para selects
    public $accesos = [];

    public function mount()
    {
        //$this->accesos = Acceso::orderBy('acceso')->get(['id', 'acceso']);
    }

    protected function rules()
    {
        return [
            'chapa'            => ['required', 'string', 'min:1', 'max:10'],
            'acceso_salida_id' => ['required', Rule::exists(Acceso::class, 'id')],
        ];
    }

    /** ─────────────────────────────────────────────
     *  Eventos de actualización
     * ────────────────────────────────────────────── */
    public function updatedChapa($value)
    {
        # VALIDACION SI NO SE ENCUENTRA UNA ENTRADA DE ESE VEHICULO
        if (IngresoVehiculoService::intentaSalirSinIngreso($this->chapa)) {
            $this->addError('chapa', 'Vehiculo No Registra Entrada.');
            return;
        }

        $this->resetVehiculoForm();

        $this->registro = IngresoVehiculo::with(['vehiculo', 'personaIngreso'])
            ->whereHas('vehiculo', function (Builder $query) use ($value) {
                $query->where('chapa', $value);
            })->orderByDesc('created_at')->whereNull('fecha_hora_salida')->first();

            $this->accesos = Acceso::where('empresa_id', $this->registro->empresa_id)->orderBy('acceso')->get(['id', 'acceso']);
    }

    /** ─────────────────────────────────────────────
     *  Métodos auxiliares (limpieza y relleno)
     * ────────────────────────────────────────────── */
    private function resetVehiculoForm()
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
        
        // $img = $this->imagen->store(path: "ingreso-vehiculos/salida/" . Carbon::now()->format('Y/m/d'));

        $this->registro->update([
            'fecha_hora_salida'       => Carbon::now(),
            'acceso_salida_id'        => $this->acceso_salida_id,
            'usuario_registro_salida' => Auth::id(),
            'corresponde_salida'      => true,
            'img_entrada'                => null,
            'actualizado_por'         => Auth::id(),
        ]);

        session()->flash('success', 'Salida registrada correctamente.');
        return redirect()->route('cda.panel-central.index');
    }

    public function render()
    {
        return view('livewire.cda.ingreso-vehiculo.salida');
    }
}
