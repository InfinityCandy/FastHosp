@extends('layouts.principal')


@section('titulo', 'Notificaciones')

@section('opcionesMenu')
   
    @include('layouts.administrativoFamiliarMenu')
    
@endsection

@section('userMenu')

    @include('layouts.administrativoFamiliarUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Notificaciones')
   
   <div class="statusMessageContainer">
       @if (session('succesStatus'))
           <h1 class="succes">{{ session('succesStatus') }}</h1>
           <p><strong>{{ session('nombreMedico') }}</strong></p>
           <p><strong>{{ session('expedienteMedico') }}</strong></p>
           <p><strong>{{ session('fechaCita') }}</strong></p>
           <p><strong>{{ session('horaCita') }}</strong></p>
           <p><strong>{{ session('consultorio') }}</strong></p>
       @endif
       
       @if (session('errorStatus'))
           <h1 class="error">{{ session('errorStatus') }}</h1>
       @endif
   </div>
   
   
   
@endsection