@extends('layouts.pdf.plantilla')

{{-- @section('titulo', 'TITULO') --}}

{{-- @section('departamento', 'Central de Comunicaciones y Alarmas') --}}

{{-- Definimos los logos para este reporte --}}
{{-- @section('logo_izq', public_path('img/logos/logo-especial.png'))
    @section('logo_der', public_path('img/logos/logo-secundario.png')) --}}


@section('contenido')
    <div class="subtitulo">Reporte de Roles</div>

    <table class="tabla">
        <thead class="tabla-thead">
            <tr>
                <th>Nombre</th>
                <th>Creado El</th>
            </tr>
        </thead>

        <tbody class="tabla-tbody">
            @forelse ($datos as $rol)
                <tr>
                    <td>{{ $rol->name ?? 'S/D' }}</td>
                    <td>{{ !empty($rol->created_at) ? date('d/m/Y H:i:s', strtotime($rol->created_at)) : 'S/D' }}
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
