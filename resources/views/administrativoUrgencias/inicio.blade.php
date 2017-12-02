@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.administrativoUrgenciasMenu')
    
@endsection

@section('userMenu')

    @include('layouts.administrativoUrgenciasUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   
@endsection