@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.farmaceuticoMenu')
    
@endsection

@section('userMenu')

    @include('layouts.farmaceuticoUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   
@endsection