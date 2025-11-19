@extends('layouts.pdf.plantilla')

@section('titulo', 'Usuarios')

{{-- @section('departamento', 'Central de Comunicaciones y Alarmas') --}}

{{-- Definimos los logos para este reporte --}}
{{-- @section('logo_izq', public_path('img/logos/logo-especial.png'))
    @section('logo_der', public_path('img/logos/logo-secundario.png')) --}}


@section('contenido')
    <div class="subtitulo">Reporte de Usuarios</div>

    <table class="tabla">
        <thead class="tabla-thead">
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Nro. Cedula</th>
                <th>Nro. Celular</th>
                <th>Empresa</th>
                <th>Sucursal</th>
                <th>Departamento</th>
                <th>Obs.</th>
                <th>Activo</th>
                <th>Ultimo Acceso</th>
            </tr>
        </thead>

        <tbody class="tabla-tbody">
            @forelse ($datos as $usuario)
                <tr>
                    <td>{{ $usuario->name ?? 'S/D' }}</td>
                    <td>{{ $usuario->usuario ?? 'S/D' }}</td>
                    <td>{{ $usuario->email ?? 'S/D' }}</td>
                    <td>{{ $usuario->nro_cedula ?? 'S/D' }}</td>
                    <td>{{ $usuario->nro_celular ?? 'S/D' }}</td>
                    <td>{{ $usuario->empresa->empresa ?? 'S/D' }}</td>
                    <td>{{ $usuario->sucursal->sucursal ?? 'S/D' }}</td>
                    <td>{{ $usuario->departamento->departamento ?? 'S/D' }}</td>
                    <td>{{ $usuario->observacion ?? 'S/D' }}</td>
                    <td>{{ $usuario->activo ? 'SI' : 'NO' }}</td>
                    <td>{{ !empty($usuario->ultimo_acceso) ? date('d/m/Y H:i:s', strtotime($usuario->ultimo_acceso)) : 'S/D' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" style="font-style: italic; text-align: center">SIN REGISTROS</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@push('styles')
@endpush
