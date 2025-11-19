@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Vehiculo')
@section('content_header_title', 'Vehiculo')
@section('content_header_subtitle', 'Salida')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('cda.ingreso-vehiculo.salida')
@stop

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
