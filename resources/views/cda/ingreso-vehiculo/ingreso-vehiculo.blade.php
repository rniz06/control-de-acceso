@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Vehiculo')
@section('content_header_title', 'Vehiculo')
@section('content_header_subtitle', 'Ingreso')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('cda.ingreso-vehiculo.ingreso')
@stop

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
