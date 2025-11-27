@extends('layouts.pdf.plantilla')

@section('titulo', 'Salidas')

{{-- @section('departamento', 'Central de Comunicaciones y Alarmas') --}}

{{-- Definimos los logos para este reporte --}}
{{-- @section('logo_izq', public_path('img/logos/logo-especial.png'))
    @section('logo_der', public_path('img/logos/logo-secundario.png')) --}}


@section('contenido')
    <div class="subtitulo">Reporte de Salidas</div>

    <table class="tabla">
        <thead class="tabla-thead">
            <tr>
                <th>Fecha Salida</th>
                <th>Vehiculo</th>
                <th>Registro Salida</th>
                <th>Empresa</th>
                <th>Sucursal</th>
                <th>Acceso</th>
            </tr>
        </thead>

        <tbody class="tabla-tbody">
            @forelse ($datos as $salida)
                <tr>
                    <td>{{ optional($salida->fecha_hora_salida)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                    <td>{{ $salida->vehiculo->chapa ?? 'S/D' }}</td>
                    <td>{{ $salida->usuarioRegistroSalida->name ?? 'S/D' }}</td>
                    <td>{{ $salida->empresa->empresa ?? 'S/D' }}</td>
                    <td>{{ $salida->sucursal->sucursal ?? 'S/D' }}</td>
                    <td>{{ $salida->accesoSalida->acceso ?? 'S/D' }}</td>
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
