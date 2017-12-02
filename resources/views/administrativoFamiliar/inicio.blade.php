@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.administrativoFamiliarMenu')
    
@endsection

@section('userMenu')

    @include('layouts.administrativoFamiliarUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   
@endsection