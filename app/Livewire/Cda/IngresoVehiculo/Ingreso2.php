<?php

namespace App\Livewire\Cda\IngresoVehiculo;

use App\Models\Acceso;
use App\Models\Cda\{Color, IngresoVehiculo, Marca, Modelo, Persona, Vehiculo};
use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Ingreso2 extends Component
{
    // Datos del ingreso
    public $empresa_id  = 2, $sucursal_id = 2, $vehiculo_id; // POR DEFECTO LUISITO

    // Datos del vehículo
    #[Validate]
    public $chapa, $nro_movil, $marca_id, $modelo_id, $color_id, $acceso_ingreso_id;

    // Opciones para selects
    public $marcas = [], $modelos = [], $colores = [], $accesos = [], $empresas = [], $sucursales = [];

    // Bloqueos de formularios
    public $bloqueoFormVehiculo = true;

    public function mount()
    {
        $this->marcas = Marca::orderBy('marca')->get(['id', 'marca']);
        $this->modelos = Modelo::orderBy('modelo')->get(['id', 'modelo']);
        $this->colores = Color::orderBy('color')->get(['id', 'color']);
        $this->accesos = Acceso::where('empresa_id', $this->empresa_id)->orderBy('acceso')->get(['id', 'acceso']);
        $this->empresas = Empresa::orderBy('empresa')->get(['id', 'empresa']);
        $this->sucursales = Sucursal::where('empresa_id', $this->empresa_id)->orderBy('sucursal')->get(['id', 'sucursal']);
    }

    protected function rules()
    {
        return [
            'chapa'               => ['required', 'string', 'min:1', 'max:10'],
            'nro_movil'   => [
                'nullable',
                'string',
                'min_digits:1',
                'max_digits:5',
                //Rule::unique(Vehiculo::class, 'nro_movil')->where('empresa_id', $this->empresa_id)
            ],
            'marca_id'            => ['required', Rule::exists(Marca::class, 'id')],
            'modelo_id'           => ['required', Rule::exists(Modelo::class, 'id')],
            'color_id'            => ['required', Rule::exists(Color::class, 'id')],
            'acceso_ingreso_id'   => ['required', Rule::exists(Acceso::class, 'id')],
            'empresa_id'          => ['required', Rule::exists(Empresa::class, 'id')],
            'sucursal_id'         => ['required', Rule::exists(Sucursal::class, 'id')]
        ];
    }

    public function grabar()
    {
        $this->validate();

        # VALIDAR SI EL VEHICULO INGRESO ANTERIORMEMTE Y REGISTRO SALIDA, SINO LANZAR ALERTA
        // if (IngresoVehiculoService::tieneSalidaPendiente($this->chapa)) {
        //     $this->addError('chapa', 'Este vehículo registra un ingreso sin salida registrada.');
        //     return;
        // }

        DB::transaction(function () {
            $this->vehiculo_id = $this->vehiculo_id ?: Vehiculo::create([
                'chapa'      => $this->chapa,
                'nro_movil'  => $this->nro_movil,
                'marca_id'   => $this->marca_id,
                'modelo_id'  => $this->modelo_id,
                'color_id'   => $this->color_id,
                'empresa_id' => $this->empresa_id,
                'creado_por' => Auth::id(),
            ])->id;

            IngresoVehiculo::create([
                'fecha_hora_ingreso'       => now(),
                'vehiculo_id'              => $this->vehiculo_id,
                'acceso_ingreso_id'        => $this->acceso_ingreso_id,
                'empresa_id'               => $this->empresa_id,
                'sucursal_id'              => $this->sucursal_id,
                'img_entrada'              => null,
                'usuario_registro_ingreso' => Auth::id(),
                'corresponde_salida'       => false,
                'creado_por'               => Auth::id(),
            ]);
        });

        session()->flash('success', 'Ingreso registrado correctamente.');
        return redirect()->route('cda.panel-central.index');
    }

    public function render()
    {
        return view('livewire.cda.ingreso-vehiculo.ingreso2');
    }

    /* ─────────────────────────────────────────────
     *  Eventos de actualización
     * ────────────────────────────────────────────── */

    # AL ACTUALIZAR EMPRESA_ID
    public function updatedEmpresaId($value)
    {
        $this->sucursales = Sucursal::where('empresa_id', $value)->orderBy('sucursal')->get(['id', 'sucursal']);
        $this->accesos = Acceso::where('empresa_id', $this->empresa_id)->orderBy('acceso')->get(['id', 'acceso']);
    }

    # AL ACTUALIZAR CHAPA
    public function updatedChapa($value)
    {
        $this->resetVehiculoForm();

        $vehiculo = Vehiculo::with(['marca:id,marca', 'modelo:id,modelo', 'color:id,color'])
            ->select('id', 'chapa', 'nro_movil', 'marca_id', 'modelo_id', 'color_id')
            ->where('chapa', $value)
            ->first();

        if ($vehiculo) {
            $this->fillVehiculo($vehiculo);
        } else {
            $this->bloqueoFormVehiculo = false;
        }
    }

    # AL ACTUALIZAR NRO_MOVIL
    public function updatedNroMovil($value)
    {
        $this->resetVehiculoForm();

        $vehiculo = Vehiculo::with(['marca:id,marca', 'modelo:id,modelo', 'color:id,color'])
            ->select('id', 'chapa', 'nro_movil', 'marca_id', 'modelo_id', 'color_id')
            ->where([['empresa_id', $this->empresa_id], ['nro_movil', $value]])
            ->first();

        if ($vehiculo) {
            $this->fillVehiculo($vehiculo);
        } else {
            $this->bloqueoFormVehiculo = false;
        }
    }

    # AL ACTUALIZAR MARCA_ID
    public function updatedMarcaId($value)
    {
        $this->modelo_id = '';
        $this->modelos = Modelo::where('marca_id', $value)
            ->orderBy('modelo')
            ->get(['id', 'modelo']);
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
        $this->chapa       = $vehiculo->chapa;
        $this->nro_movil   = $vehiculo->nro_movil;
        $this->marca_id    = $vehiculo->marca_id;
        $this->modelo_id   = $vehiculo->modelo_id;
        $this->color_id    = $vehiculo->color_id;
    }
}
