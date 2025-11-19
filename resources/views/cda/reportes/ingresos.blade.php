@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Reportes')
@section('content_header_title', 'Reportes')
@section('content_header_subtitle', 'Ingreso')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('cda.reportes.ingreso')
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
