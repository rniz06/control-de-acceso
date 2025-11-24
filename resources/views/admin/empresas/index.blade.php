@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Empresas')
@section('content_header_title', 'Empresas')
@section('content_header_subtitle', 'Listar')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- Mostrar un alert en caso de haber algun mensaje --}}
    @if ($message = Session::get('success'))
        <x-adminlte-callout icon="fas fa-check-circle" theme="success" title="{{ $message }}" title-class="text-success" />
    @endif
    @livewire('admin.empresas.index')
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
