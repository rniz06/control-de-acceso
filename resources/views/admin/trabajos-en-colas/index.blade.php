@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Trabajos en Colas')
@section('content_header_title', 'Trabajos en Colas')
@section('content_header_subtitle', 'Listar')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('admin.trabajos-en-colas.index')
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