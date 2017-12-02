@extends('layouts.principal')


@section('titulo', 'Peticiones en farmacia')

@section('opcionesMenu')
   
    @include('layouts.farmaceuticoMenu')
    
@endsection

@section('userMenu')

    @include('layouts.farmaceuticoUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Peticiones de Farmacia')
    <div class="row">
       @foreach($peticiones as $peticion) 
            <a href="/verPeticionDeFarmacia/{{$peticion->expedienteDelPaciente}}">
                <div class="col-xs-12 medicineRequestContainer">
                    <input type="submit" value="Expediente: {{$peticion->expedienteDelPaciente}}" class="medicineRequest"> 
                </div>
            </a>
       @endforeach
   </div>

@endsection