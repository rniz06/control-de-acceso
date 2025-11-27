<?php

namespace App\Livewire\Cda\Reportes;

use App\Exports\Excel\Cda\Reportes\ExcelListadoIngresos;
use App\Exports\Pdf\Cda\Reportes\PdfListadoIngresos;
use App\Models\Acceso;
use App\Models\Cda\IngresoVehiculo;
use App\Models\Cda\Persona;
use App\Models\Empresa;
use App\Models\Sucursal;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Ingreso extends Component
{
    use WithPagination;

    // #[Url]
    public $buscarFechaHoraIngreso, $buscarVehiculoPorChapa = '', $buscarEmpresaId = '', $buscarSucursalId = '', $buscarAccesoId = '';

    public $empresas = [], $sucursales = [], $accesos = []; // PROPIEDADES PARA LOS SELECT

    public $paginado = 5;

    public function mount()
    {
        $this->buscarFechaHoraIngreso = Carbon::now()->toDateString();
        $this->empresas               = Empresa::get(['id', 'empresa']);
        $this->sucursales             = Sucursal::get(['id', 'sucursal']);
        $this->accesos                = Acceso::get(['id', 'acceso']);
    }

    public function render()
    {
        return view('livewire.cda.reportes.ingreso', [
            'ingresos' => IngresoVehiculo::select(
                'id',
                'fecha_hora_ingreso',
                'vehiculo_id',
                'acceso_ingreso_id',
                'usuario_registro_ingreso',
                'empresa_id',
                'sucursal_id'
            )->buscarFechaHoraIngreso($this->buscarFechaHoraIngreso)
                ->buscarVehiculoPorChapa($this->buscarVehiculoPorChapa)
                ->buscarEmpresaId($this->buscarEmpresaId)
                ->buscarSucursalId($this->buscarSucursalId)
                ->buscarAccesoId($this->buscarAccesoId)
                ->with([
                    'vehiculo:id,chapa',
                    'accesoIngreso:id,acceso',
                    'usuarioRegistroIngreso:id,name',
                    'empresa:id,empresa',
                    'sucursal:id,sucursal'
                ])->orderBy('fecha_hora_ingreso', 'desc')->paginate($this->paginado)
        ]);
    }

    public function updatedBuscarEmpresaId($empresa_id)
    {
        $this->sucursales = Sucursal::where('empresa_id', $empresa_id)->get(['id', 'sucursal']);
        $this->accesos    = Acceso::where('empresa_id', $empresa_id)->get(['id', 'acceso']);
    }

    public function cargarDatosParaExpotar()
    {
        return IngresoVehiculo::select(
            'id',
            'fecha_hora_ingreso',
            'vehiculo_id',
            'acceso_ingreso_id',
            'usuario_registro_ingreso',
            'empresa_id',
            'sucursal_id'
        )->buscarFechaHoraIngreso($this->buscarFechaHoraIngreso)
            ->buscarVehiculoPorChapa($this->buscarVehiculoPorChapa)
            ->buscarEmpresaId($this->buscarEmpresaId)
            ->buscarSucursalId($this->buscarSucursalId)
            ->buscarAccesoId($this->buscarAccesoId)
            ->with([
                'vehiculo:id,chapa',
                'accesoIngreso:id,acceso',
                'usuarioRegistroIngreso:id,name',
                'empresa:id,empresa',
                'sucursal:id,sucursal'
            ])->orderBy('fecha_hora_ingreso', 'desc')->get();
    }

    public function excel()
    {
        $datos = $this->cargarDatosParaExpotar();

        return Excel::download(new ExcelListadoIngresos($datos), 'Ingresos.xlsx');
    }

    public function pdf()
    {
        $nombre_archivo = "Ingresos";
        $datos = $this->cargarDatosParaExpotar();

        return (new PdfListadoIngresos($datos, $nombre_archivo))->download();
    }
}
