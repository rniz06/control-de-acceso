@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Usuarios')
@section('content_header_title', 'Usuarios')
@section('content_header_subtitle', 'Listar')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('admin.usuarios.index')
@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')
    
@endpush