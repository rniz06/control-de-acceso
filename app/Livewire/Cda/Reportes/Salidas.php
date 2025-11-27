<?php

namespace App\Livewire\Cda\Reportes;

use App\Exports\Excel\Cda\Reportes\ExcelListadoSalidas;
use App\Exports\Pdf\Cda\Reportes\PdfListadoSalidas;
use App\Models\{Empresa, Sucursal, Acceso};
use App\Models\Cda\IngresoVehiculo;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Salidas extends Component
{
    use WithPagination;

    // #[Url]
    public $buscarFechaHoraSalida, $buscarVehiculoPorChapa = '', $buscarEmpresaId = '', $buscarSucursalId = '', $buscarAccesoId = '';

    public $empresas = [], $sucursales = [], $accesos = []; // PROPIEDADES PARA LOS SELECT

    public $paginado = 5;

    public function mount()
    {
        $this->buscarFechaHoraSalida  = Carbon::now()->toDateString();
        $this->empresas               = Empresa::get(['id', 'empresa']);
        $this->sucursales             = Sucursal::get(['id', 'sucursal']);
        $this->accesos                = Acceso::get(['id', 'acceso']);
    }

    public function render()
    {
        return view('livewire.cda.reportes.salidas', [
            'salidas' => IngresoVehiculo::select(
                'id',
                'fecha_hora_salida',
                'vehiculo_id',
                'acceso_salida_id',
                'usuario_registro_salida',
                'empresa_id',
                'sucursal_id'
            )->buscarFechaHoraSalida($this->buscarFechaHoraSalida)
                ->buscarVehiculoPorChapa($this->buscarVehiculoPorChapa)
                ->buscarEmpresaId($this->buscarEmpresaId)
                ->buscarSucursalId($this->buscarSucursalId)
                ->buscarAccesoId($this->buscarAccesoId)
                ->where('corresponde_salida', true)
                ->with([
                    'vehiculo:id,chapa',
                    'accesoSalida:id,acceso',
                    'usuarioRegistroSalida:id,name',
                    'empresa:id,empresa',
                    'sucursal:id,sucursal'
                ])->orderBy('fecha_hora_salida', 'desc')->paginate($this->paginado)
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
            'fecha_hora_salida',
            'vehiculo_id',
            'acceso_salida_id',
            'usuario_registro_salida',
            'empresa_id',
            'sucursal_id'
        )->buscarFechaHoraSalida($this->buscarFechaHoraSalida)
            ->buscarVehiculoPorChapa($this->buscarVehiculoPorChapa)
            ->buscarEmpresaId($this->buscarEmpresaId)
            ->buscarSucursalId($this->buscarSucursalId)
            ->buscarAccesoId($this->buscarAccesoId)
            ->where('corresponde_salida', true)
            ->with([
                'vehiculo:id,chapa',
                'accesoSalida:id,acceso',
                'usuarioRegistroSalida:id,name',
                'empresa:id,empresa',
                'sucursal:id,sucursal'
            ])->orderBy('fecha_hora_salida', 'desc')->get();
    }

    public function excel()
    {
        $datos = $this->cargarDatosParaExpotar();

        return Excel::download(new ExcelListadoSalidas($datos), 'Salidas.xlsx');
    }

    public function pdf()
    {
        $nombre_archivo = "Salidas";
        $datos = $this->cargarDatosParaExpotar();

        return (new PdfListadoSalidas($datos, $nombre_archivo))->download();
    }
}
