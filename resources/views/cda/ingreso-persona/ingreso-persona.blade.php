@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Persona')
@section('content_header_title', 'Persona')
@section('content_header_subtitle', 'Ingreso')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('cda.ingreso-persona.ingreso')
@stop

@push('css')
    {{-- Incluir estilos adicionales desde el componente --}}
    @stack('styles')
@endpush

{{-- Push extra scripts --}}

@push('js')
    {{-- Incluir scripts js adicionales desde el componente --}}
    @stack('scripts')
@endpush
