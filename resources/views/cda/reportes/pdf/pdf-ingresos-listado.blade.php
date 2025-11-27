@extends('layouts.pdf.plantilla')

@section('titulo', 'Ingresos')

{{-- @section('departamento', 'Central de Comunicaciones y Alarmas') --}}

{{-- Definimos los logos para este reporte --}}
{{-- @section('logo_izq', public_path('img/logos/logo-especial.png'))
    @section('logo_der', public_path('img/logos/logo-secundario.png')) --}}


@section('contenido')
    <div class="subtitulo">Reporte de Ingresos</div>

    <table class="tabla">
        <thead class="tabla-thead">
            <tr>
                <th>Fecha Ingreso</th>
                <th>Vehiculo</th>
                <th>Acceso</th>
                <th>Guardia</th>
            </tr>
        </thead>

        <tbody class="tabla-tbody">
            @forelse ($datos as $ingreso)
                <tr>
                    <td>{{ optional($ingreso->fecha_hora_ingreso)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                    <td>{{ $ingreso->vehiculo->chapa ?? 'S/D' }}</td>
                    <td>{{ $ingreso->accesoIngreso->acceso ?? 'S/D' }}</td>
                    <td>{{ $ingreso->usuarioRegistroIngreso->name ?? 'S/D' }}</td>
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
