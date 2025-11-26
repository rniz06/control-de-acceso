@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Colores')
@section('content_header_title', 'Colores')
@section('content_header_subtitle', 'Listar')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- Mostrar un alert en caso de haber algun mensaje : SUCCESS O ERROR --}}
    @if ($msg = session('success') ?? session('error'))
        <x-adminlte-callout :icon="session('success') ? 'fas fa-check-circle' : 'fas fa-times'" :theme="session('success') ? 'success' : 'danger'" :title="$msg" :title-class="session('success') ? 'text-success' : 'text-danger'" />
    @endif

    {{-- RENDERIZAR COMPONENTE LIVEWIRE --}}
    @livewire('cda.parametros.colores.index')

@stop

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
