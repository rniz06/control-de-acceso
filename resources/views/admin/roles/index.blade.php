@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Roles')
@section('content_header_title', 'Roles')
@section('content_header_subtitle', 'Listar')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('admin.roles.index')
@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')
    
@endpush