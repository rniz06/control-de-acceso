@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Vehiculos')
@section('content_header_title', 'Vehiculos')
@section('content_header_subtitle', 'Listar')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- Mostrar un alert en caso de haber algun mensaje --}}
    @if ($message = Session::get('success'))
        <x-adminlte-callout icon="fas fa-check-circle" theme="success" title="{{ $message }}" title-class="text-success" />
    @endif

    {{-- RENDERIZAR COMPONENTE LIVEWIRE --}}
    @livewire('cda.parametros.vehiculos.index')
    
@stop

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
