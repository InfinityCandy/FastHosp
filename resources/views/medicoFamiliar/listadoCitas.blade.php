@extends('layouts.principal')


@section('titulo', 'Citas')

@section('opcionesMenu')
   
    @include('layouts.medicoFamiliarMenu')
    
@endsection

@section('userMenu')

    @include('layouts.medicoFamiliarUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Citas Pedientes')
   @foreach ($pacienteInfo as $paciente)
   <a href="{{'../consulta/'.$paciente->pacienteExpediente}}">
      <div class="col-md-5 col-sm-10 col-xs-10 userDateInfoWraper">
       <div class="userDateInfoContainer">
           <div class="col-md-12">
               <img src="{{'storage/'.$paciente->foto}}" class="userDateImage">
           </div>
           <div class="col-md-12"></div>
           <div class="col-md-12">
               <h4>Expediente: {{$paciente->pacienteExpediente}}</h4>
               <h4>Nombre: {{$paciente->nombre.' '.$paciente->apellido}}</h4>
               <h4>Fecha de cita: {{$paciente->fechaDeCita}}</h4>
               <h4>Hora de cita: {{$paciente->hora}}</h4> 
           </div>
       </div>
    </div>
   </a>
   @endforeach
   
@endsection