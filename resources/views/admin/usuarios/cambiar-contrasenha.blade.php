@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Cambiar Contraseña')
@section('content_header_title', 'Cambiar Contraseña')
@section('content_header_subtitle', 'Cambiar Contraseña')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- Mostrar un alert en caso de haber algun mensaje --}}
    @if ($message = Session::get('success'))
        <x-adminlte-callout icon="fas fa-check-circle" theme="success" title="{{ $message }}" title-class="text-success" />
    @endif
    @livewire('admin.usuarios.cambiar-contrasenha')
@stop

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
