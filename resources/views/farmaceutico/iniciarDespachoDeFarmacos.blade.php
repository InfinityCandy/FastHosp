@extends('layouts.principal')


@section('titulo', 'Inofrmación de Petición')

@section('opcionesMenu')
   
    @include('layouts.farmaceuticoMenu')
    
@endsection

@section('userMenu')

    @include('layouts.farmaceuticoUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Información de Petición')
   <form method="post" action="../despacharPeticionDeFarmacia" onsubmit="return validar()">
      <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
      <input type="hidden" name="pacienteExpediente" id="pacienteExpediente" value="{{$pacienteInfo[0]->pacienteExpediente}}">
      <fieldset class="form-style-5">
       <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12 userMedicineRequestInfoWraper">
           <div class="userDateInfoContainer">
               <div class="col-md-12">
                   <img src="{{'../storage/'.$pacienteInfo[0]->foto}}" class="userMedicineRequestImage">
               </div>
               <div class="col-md-12"></div>
               <div class="col-md-12">
                   <h4><strong>Expediente</strong>: {{$pacienteInfo[0]->pacienteExpediente}}</h4>
                   <h4><strong>Nombre:</strong> {{$pacienteInfo[0]->nombre." ".$pacienteInfo[0]->apellido}}</h4>
                   <h4><strong>Medicamentos indicados:</strong> {{$pacienteInfo[0]->medicamentos}}</h4> 
               </div>
           </div>
       </div>
       
       <div class="col-md-12">
            <input type="submit" value="Despachar"> 
       </div>
       </fieldset>
   </form>
@endsection