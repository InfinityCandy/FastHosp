@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.medicoEspecialistaMenu')
    
@endsection

@section('userMenu')

    @include('layouts.medicoEspecialistaUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   
@endsection