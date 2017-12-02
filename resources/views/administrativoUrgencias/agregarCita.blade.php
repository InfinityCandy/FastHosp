@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.administrativoUrgenciasMenu')
    
@endsection

@section('userMenu')

    @include('layouts.administrativoUrgenciasUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   
   <form method="post" action="../agregarCitaUrgencias" enctype="multipart/form-data" onsubmit="return validarFechaDeCita()">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">       
        <fieldset class="form-style-5">
        
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Expediente del paciente</label>
                <input class="form-control" type="text" name="expedientePaciente" id="expedientePaciente" placeholder="X-XXXXXX-P">
                <p id="expedienteError" class="error"></p>
            </div>
            
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Expediente del médico urgenciologo</label>
                <input class="form-control" type="text" name="expedienteUrgenciologo" id="expedienteUrgenciologo" placeholder="X-XXXXXX-P">
            </div>
            
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Nombre del médico</label>
                <input class="form-control" type="text" name="nombreMedico" id="nombreMedico" placeholder="Marco Antonio Barrera Morales">
            </div>
        
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Consultorio</label>
                <input class="form-control" type="text" name="consultorio" id="consultorio" placeholder="X-XXXXXX-P">
            </div>
        
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Turno</label>
                <input class="form-control" type="text" name="turno" id="turno">
            </div>
            
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Fecha de hoy</label>
                <input class="form-control" type="date" name="fechaDeHoy" id="fechaDeHoy">
            </div>
            
            <div class="col-sm-12 sumbmitButtonCotainer">
                <input type="submit" value="Eviar"> 
                <p id="serverError" class="error"></p>
            </div>
       </fieldset>
    </form>
    
    <script>
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth()+1;
        var year = date.getFullYear();
        
        
        var expedientePaciente = document.querySelector("#expedientePaciente");
        expedientePaciente.addEventListener("change", validaExpedientePaciente);
        
        function validaExpedientePaciente(e) {
            e.preventDefault();
            
            var expediente = expedientePaciente.value;
            
            console.log(expediente);
            
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../obtenerNombreDePaciente/"+expediente, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            xhr.onload = function() {
                if(this.responseText == "404") {
                     document.querySelector("#expedienteError").innerHTML = "Error: El expediente no existe! Verifique el expediente del paciente."   
                }
                else {
                    if(this.status == 500) {
                        document.querySelector("#serverError").innerHTML = "Error: Error de servidor, vuelva a interntarlo."
                    }
                    else {
                        if(document.querySelector("#expedienteError").innerHTML != "") {
                            document.querySelector("#expedienteError").innerHTML = "";
                        }
                    }
                }
            }
            
            xhr.send();
        }//Fin de obtenerNombreUsuario
        
        
        var expedienteUrgenciologo = document.querySelector("#expedienteUrgenciologo");
        expedienteUrgenciologo.addEventListener("focus", obtenerUrgenciologoAsignado);
        
        function obtenerUrgenciologoAsignado () {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../obtenerDatosDeUrgencia", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            xhr.onload = function() {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth()+1;
                var y = date.getFullYear();
                
                var fecha = y+"-"+m+"-"+d;
                
                var responseSplit = this.responseText.split("/");
                //console.log(responseSplit);
                
                //Obtenemos cada uno de los campos que vamos a autocompletar
                var expedienteUrgenciologo = document.querySelector("#expedienteUrgenciologo");
                var nombreMedico = document.querySelector("#nombreMedico");
                var turno = document.querySelector("#turno");
                var consultorio = document.querySelector("#consultorio");
                var fechaDeHoy = document.querySelector("#fechaDeHoy");
                console.log(fechaDeHoy.value);
                expedienteUrgenciologo.value = responseSplit[0];
                nombreMedico.value = responseSplit[1]
                turno.value = responseSplit[2];
                consultorio.value = responseSplit[3];
                fechaDeHoy.value = fecha;
                
            }
            
            xhr.send()
        }//Fin de obtenerMedicoAsignado
    </script>
   
@endsection