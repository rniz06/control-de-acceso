<?php

namespace App\Livewire\Admin\Usuarios;

use App\Exports\Excel\Admin\Usuarios\ExcelListadoUsuarios;
use App\Exports\Pdf\Admin\Usuarios\PdfListadoUsuarios;
use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    public $buscador = '', $buscarName = '', $buscarUsuario = '', $buscarEmail = '', $buscarActivo = '', $buscarEmpresaId = '';
    public $buscarSucursalId = '', $buscarDepartamentoId = '', $paginado = 5;

    public $empresas = [], $sucursales = [], $departamentos = []; // PROPIEDADES PARA LOS SELECT DE FILTROS

    public function mount()
    {
        $this->empresas      = Empresa::select('id', 'empresa')->orderBy('empresa')->get();
        $this->sucursales    = Sucursal::select('id', 'sucursal')->orderBy('sucursal')->get();
        $this->departamentos = Departamento::select('id', 'departamento')->orderBy('departamento')->get();
    }

    // Limpiar el buscador y la paginación al cambiar de pagina
    public function updating($key): void
    {
        if (in_array($key, [
            'buscador',
            'buscarName',
            'buscarUsuario',
            'buscarEmail',
            'buscarActivo',
            'buscarEmpresaId',
            'buscarSucursalId',
            'buscarDepartamentoId',
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.admin.usuarios.index', [
            'usuarios' => User::select(
                'id',
                'name',
                'usuario',
                'email',
                'nro_cedula',
                'nro_celular',
                'observacion',
                'password',
                'activo',
                'ultimo_acceso',
                'empresa_id',
                'sucursal_id',
                'departamento_id',
            )->with(['empresa:id,empresa', 'sucursal:id,sucursal', 'departamento:id,departamento'])
                ->buscador($this->buscador)
                ->buscarName($this->buscarName)
                ->buscarUsuario($this->buscarUsuario)
                ->buscarEmail($this->buscarEmail)
                ->buscarActivo($this->buscarActivo)
                ->buscarEmpresaId($this->buscarEmpresaId)
                ->buscarSucursalId($this->buscarSucursalId)
                ->buscarDepartamentoId($this->buscarDepartamentoId)
                ->paginate($this->paginado),
        ]);
    }

    // METODO PARA ACTIVAR UN USUARIO
    public function activar($id)
    {
        User::findOrFail($id)->update([
            'activo' => true,
            'actualizadoPor' => Auth::id(),
        ]);

        session()->flash('success', 'Usuario Activo Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    // METODO PARA INACTIVAR UN USUARIO
    public function inactivar($id)
    {
        User::findOrFail($id)->update([
            'activo' => false,
            'actualizadoPor' => Auth::id(),
        ]);

        session()->flash('success', 'Usuario Inactivado Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    // METODO PARA INACTIVAR UN USUARIO
    public function resetearContrasena($id)
    {
        User::findOrFail($id)->update([
            'password' => Hash::make('12345678'),
            'actualizadoPor' => Auth::id(),
        ]);

        session()->flash('success', 'Contraseña Restablecida Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    public function cargarDatosParaExpotar()
    {
        return User::select('name', 'usuario', 'email', 'nro_cedula', 'nro_celular', 'observacion', 'activo', 'ultimo_acceso', 'empresa_id', 'sucursal_id', 'departamento_id')
            ->buscador($this->buscador)
            ->buscarName($this->buscarName)
            ->buscarUsuario($this->buscarUsuario)
            ->buscarEmail($this->buscarEmail)
            ->buscarActivo($this->buscarActivo)
            ->buscarEmpresaId($this->buscarEmpresaId)
            ->buscarSucursalId($this->buscarSucursalId)
            ->buscarDepartamentoId($this->buscarDepartamentoId)
            ->with(['empresa:id,empresa', 'sucursal:id,sucursal', 'departamento:id,departamento'])
            ->orderBy('name')
            ->get();
    }

    public function excel()
    {
        $datos = $this->cargarDatosParaExpotar();
        $encabezados = ['Nombre', 'Usuario', 'Email', 'Nro. Cedula', 'Nro. Celular', 'Empresa', 'Sucursal', 'Departamento', 'Obs:', 'Activo', 'Ultimo Acceso'];

        return Excel::download(new ExcelListadoUsuarios($datos, $encabezados), 'Usuarios.xlsx');
    }

    public function pdf()
    {
        $nombre_archivo = "Usuarios";
        $datos = $this->cargarDatosParaExpotar();

        return (new PdfListadoUsuarios($datos, $nombre_archivo))->download();
    }
}
