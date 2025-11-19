@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Inicio')
@section('content_header_title', 'Inicio')
@section('content_header_subtitle', 'Bienvenido')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- Mostrar un alert en caso de haber algun mensaje --}}
    @if ($message = Session::get('success'))
        <x-adminlte-callout icon="fas fa-check-circle" theme="success" title="{{ $message }}" title-class="text-success" />
    @endif

    <p>Panel Central del Control de Acceso.</p>
    @livewire('cda.panel-central')
@stop

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
