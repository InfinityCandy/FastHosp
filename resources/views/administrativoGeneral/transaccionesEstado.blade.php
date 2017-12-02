@extends('layouts.principal')


@section('titulo', 'Notificaciones')

@section('opcionesMenu')
   
    @include('layouts.administrativoGeneralMenu')
    
@endsection

@section('userMenu')

     @include('layouts.administrativoGeneralUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Notificaciones')
   
   <div class="statusMessageContainer">
       @if (session('succesStatus'))
           <h1 class="succes">{{ session('succesStatus') }}</h1>
       @endif
       
       @if (session('errorStatus'))
           <h1 class="error">{{ session('errorStatus') }}</h1>
       @endif
   </div>
   
   
   
@endsection