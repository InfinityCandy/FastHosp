@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.medicoFamiliarMenu')
    
@endsection

@section('userMenu')

    @include('layouts.medicoFamiliarUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   
@endsection