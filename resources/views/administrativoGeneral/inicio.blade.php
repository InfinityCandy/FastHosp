@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.administrativoGeneralMenu')
    
@endsection

@section('userMenu')

    @include('layouts.administrativoGeneralUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   
@endsection