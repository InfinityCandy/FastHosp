@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.urgenciologoMenu')
    
@endsection

@section('userMenu')

    @include('layouts.urgenciologoUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   
@endsection