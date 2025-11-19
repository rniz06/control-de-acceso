@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Persona')
@section('content_header_title', 'Persona')
@section('content_header_subtitle', 'Salida')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('cda.ingreso-persona.salida')
@stop

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
