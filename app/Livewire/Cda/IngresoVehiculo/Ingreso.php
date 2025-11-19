<?php

namespace App\Livewire\Cda\IngresoVehiculo;

use App\Models\Acceso;
use App\Models\Cda\{Color, IngresoVehiculo, Marca, Modelo, Persona, Vehiculo};
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Services\Cda\Validaciones\IngresoVehiculoService;
// use App\Models\Cda\IngresoVehiculo;
// use App\Models\Cda\Marca;
// use App\Models\Cda\Modelo;
// use App\Models\Cda\Persona;
// use App\Models\Cda\Vehiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Ingreso extends Component
{
    use WithFileUploads;

    // Datos del ingreso
    public $empresa_id  = 2, $sucursal_id = 2; // POR DEFECTO LUISITO

    // Datos del ingreso
    #[Validate]
    public $vehiculo_id, $persona_ingresa_id, $persona_visita_id = 1, $acceso_ingreso_id = 4; #ACCESO PRINCIPAL LUISITO

    // Datos del vehículo
    #[Validate]
    public $chapa, $marca_id, $modelo_id, $color_id;

    // Datos de la persona que ingresa
    #[Validate]
    public $pi_nombre_completo, $pi_nro_cedula;

    // Opciones para selects
    public $marcas, $modelos, $colores, $personasVisitables, $accesos, $empresas = [], $sucursales = [];

    // Bloqueos de formularios
    public $bloqueoFormVehiculo = true;
    public $bloqueoFormPerIngresa = true;

    public function mount()
    {
        // Carga inicial optimizada: solo columnas necesarias, ordenadas
        $this->marcas = Marca::orderBy('marca')->get(['id', 'marca']);
        $this->modelos = Modelo::orderBy('modelo')->get(['id', 'modelo', 'marca_id']);
        $this->colores = Color::orderBy('color')->get(['id', 'color']);
        $this->personasVisitables = Persona::where('esPersonalEmpresa', true)
            ->orderBy('nombre_completo')
            ->get(['id', 'nombre_completo']);
        $this->accesos = Acceso::where('empresa_id', $this->empresa_id)->orderBy('acceso')->get(['id', 'acceso']);

        $this->empresas = Empresa::orderBy('empresa')->get(['id', 'empresa']);
        $this->sucursales = Sucursal::where('empresa_id', $this->empresa_id)->orderBy('sucursal')->get(['id', 'sucursal']);
    }

    protected function rules()
    {
        return [
            'chapa'               => ['required', 'string', 'min:1', 'max:10'],
            'marca_id'            => ['required', Rule::exists(Marca::class, 'id')],
            'modelo_id'           => ['required', Rule::exists(Modelo::class, 'id')],
            'color_id'            => ['required', Rule::exists(Color::class, 'id')],
            'pi_nro_cedula'       => ['nullable', 'string', 'min:1', 'max:15'],
            'pi_nombre_completo'  => ['nullable', 'string'],
            'persona_visita_id'   => ['required', Rule::exists(Persona::class, 'id')],
            'acceso_ingreso_id'   => ['required', Rule::exists(Acceso::class, 'id')],
        ];
    }

    /** ─────────────────────────────────────────────
     *  Eventos de actualización
     * ────────────────────────────────────────────── */

    public function updatedEmpresaId($value)
    {
        $this->sucursales = Sucursal::where('empresa_id', $value)->orderBy('sucursal')->get(['id', 'sucursal']);
        $this->accesos = Acceso::where('empresa_id', $this->empresa_id)->orderBy('acceso')->get(['id', 'acceso']);
    }
    public function updatedChapa($value)
    {
        $this->resetVehiculoForm();

        $vehiculo = Vehiculo::with(['marca:id,marca', 'modelo:id,modelo', 'color:id,color'])
            ->select('id', 'marca_id', 'modelo_id', 'color_id')
            ->where('chapa', $value)
            ->first();

        if ($vehiculo) {
            $this->fillVehiculo($vehiculo);
        } else {
            $this->bloqueoFormVehiculo = false;
        }
    }

    public function updatedMarcaId($value)
    {
        $this->modelo_id = '';
        $this->modelos = Modelo::where('marca_id', $value)
            ->orderBy('modelo')
            ->get(['id', 'modelo', 'marca_id']);
    }

    public function updatedPiNroCedula($value)
    {
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
    private function resetVehiculoForm()
    {
        $this->bloqueoFormVehiculo = true;
        $this->marca_id = $this->modelo_id = $this->color_id = '';
        $this->vehiculo_id = null;
    }

    private function fillVehiculo($vehiculo)
    {
        $this->vehiculo_id = $vehiculo->id;
        $this->marca_id    = $vehiculo->marca_id;
        $this->modelo_id   = $vehiculo->modelo_id;
        $this->color_id    = $vehiculo->color_id;
    }

    private function resetPersonaForm()
    {
        $this->bloqueoFormPerIngresa = true;
        $this->pi_nombre_completo = '';
        $this->persona_ingresa_id = null;
    }

    private function fillPersona($persona)
    {
        $this->pi_nombre_completo = $persona->nombre_completo;
        $this->persona_ingresa_id = $persona->id;
    }

    /** ────────────────────────────────────────────
     *  Registro de ingreso
     * ────────────────────────────────────────────── */
    public function grabar()
    {
        $this->validate();

        # VALIDAR SI EL VEHICULO INGRESO ANTERIORMEMTE Y REGISTRO SALIDA, SINO LANZAR ALERTA
        if (IngresoVehiculoService::tieneSalidaPendiente($this->chapa)) {
            $this->addError('chapa', 'Este vehículo registra un ingreso sin salida registrada.');
            return;
        }

        DB::transaction(function () {
            $this->vehiculo_id = $this->vehiculo_id ?: Vehiculo::create([
                'chapa'      => $this->chapa,
                'marca_id'   => $this->marca_id,
                'modelo_id'  => $this->modelo_id,
                'color_id'   => $this->color_id,
                'creado_por' => Auth::id(),
            ])->id;

            $this->persona_ingresa_id = $this->persona_ingresa_id ?: Persona::create([
                'nombre_completo' => $this->pi_nombre_completo,
                'nro_cedula'      => $this->pi_nro_cedula,
                'creado_por'      => Auth::id(),
            ])->id;

            // $img = $this->imagen->store(path: "ingreso-vehiculos/ingreso/" . Carbon::now()->format('Y/m/d'));

            IngresoVehiculo::create([
                'fecha_hora_ingreso'       => now(),
                'vehiculo_id'              => $this->vehiculo_id,
                'persona_ingresa_id'       => $this->persona_ingresa_id,
                'persona_visita_id'        => $this->persona_visita_id,
                'acceso_ingreso_id'        => $this->acceso_ingreso_id,
                'empresa_id'               => $this->empresa_id,
                'sucursal_id'              => $this->sucursal_id,
                'img_entrada'              => null,
                'usuario_registro_ingreso' => Auth::id(),
                'creado_por'               => Auth::id(),
            ]);

        });

        session()->flash('success', 'Ingreso registrado correctamente.');
        return redirect()->route('cda.panel-central.index');
    }

    public function render()
    {
        return view('livewire.cda.ingreso-vehiculo.ingreso');
    }
}
