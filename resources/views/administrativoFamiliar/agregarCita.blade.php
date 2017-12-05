@extends('layouts.principal')


@section('titulo', 'AgregarCita')

@section('opcionesMenu')
   
    @include('layouts.administrativoFamiliarMenu')
    
@endsection

@section('userMenu')

    @include('layouts.administrativoFamiliarUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Registrar Nueva Cita')
   
   <form method="post" action="../agregarCita" enctype="multipart/form-data" onsubmit="return validarFechaDeCita()">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">       
        <fieldset class="form-style-5">
        
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Expediente del paciente</label>
                <input class="form-control" type="text" name="expedientePaciente" id="expedientePaciente" placeholder="X-XXXXXX-P" required>
                <p id="expedienteError" class="error"></p>
            </div>
            
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Nombre del paciente</label>
                <input class="form-control" type="text" name="nombrePaciente" id="nombrePaciente" placeholder="Miguel Ángel Pimentel Arriaga" required>
            </div>
            
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="turnoDeCita">Horario de consulta</label>
                <select class="form-control" name="turnoDeCita" id="turnoDeCita">
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
            </div>
        
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Expediente del médico</label>
                <input class="form-control" type="text" name="expedienteMedico" id="expedienteMedico" placeholder="X-XXXXXX-P" required>
            </div>
        
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Fecha de cita</label>
                <input class="form-control" type="date" name="fechaDeCita" id="fechaDeCita" required>
                <p id="citaError" class="error"></p>
            </div>
            
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="nombre">Hora de cita</label>
                <input class="form-control" type="text" name="horaCita" id="horaCita" required>
                <p class="alert" id="alertHoraDeCita"></p>
            </div>
            
            <div class="col-md-6 col-md-offset-3 form-group">
                <label for="consultorio">Consultorio</label>
                <select class="form-control" name="consultorio" id="consultorio">
                    <option value="10">Consultorio 10</option>
                    <option value="11">Consultorio 11</option>
                    <option value="12">Consultorio 12</option>
                    <option value="13">Consultorio 13</option>
                    <option value="14">Consultorio 14</option>
                    <option value="15">Consultorio 15</option>
                </select>
            </div>
            
            <div class="col-sm-12 sumbmitButtonCotainerCitas">
                <input type="submit" value="Agendar"> 
                <p id="serverError" class="error"></p>
            </div>
       </fieldset>
    </form>
    
    <script>
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth()+1;
        var year = date.getFullYear();
        
        function validarFechaDeCita () {
            var fechaCita = document.querySelector("#fechaDeCita");
            var fechaC = fechaCita.value;
            var fechaC = fechaC.split("-");
            
            if(year > fechaC[0]) {
                document.querySelector("#citaError").innerHTML = "Error: Verifique la fecha de la cita";
                return false;
            }
            else {
                if(month > fechaC[1]) {
                    document.querySelector("#citaError").innerHTML = "Error: Verifique la fecha de la cita";
                    return false;
                }
                else {
                    if(day > fechaC[2]) {
                        document.querySelector("#citaError").innerHTML = "Error: Verifique la fecha de la cita";
                        return false;
                    }
                     else {
                         document.querySelector("#citaError").innerHTML = "";
                         return true;
                     }
                }

            }
        }//Fin de validarFechaDeCita
        
        
        var expedientePaciente = document.querySelector("#expedientePaciente");
        expedientePaciente.addEventListener("change", obtenerNombreUsuario);
        
        function obtenerNombreUsuario(e) {
            e.preventDefault();
            
            var expediente = expedientePaciente.value;
            
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../obtenerNombreDePaciente/"+expediente, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            xhr.onload = function() {
                if(this.responseText == "404") {
                     document.querySelector("#expedienteError").innerHTML = "Error: El expediente no existe! Verifique el expediente del paciente.";
                }
                else {
                    if(document.querySelector("#expedienteError").innerHTML != "") {
                        document.querySelector("#expedienteError").innerHTML = "";
                    }
                    
                    if(this.status == 500) {
                        document.querySelector("#serverError").innerHTML = "Error: Error de servidor, vuelva a interntarlo.";
                    }
                    else {
                        if(document.querySelector("#serverError").innerHTML != "") {
                            document.querySelector("#serverError").innerHTML = "";
                        }
                        document.querySelector("#nombrePaciente").value = this.responseText; 
                    }
                }
            }
            
            xhr.send();
        }//Fin de obtenerNombreUsuario
        
        var expedienteMedico = document.querySelector("#expedienteMedico");
        var turnoDeCita = document.querySelector("#turnoDeCita");
        
        expedienteMedico.addEventListener("focus", obtenerMedicoAsignado);
        turnoDeCita.addEventListener("change", obtenerMedicoAsignado);
        
        function obtenerMedicoAsignado () {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../obtenerMedicoAsignado/"+turnoDeCita.value, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            xhr.onload = function() {
                var responseSplit = this.responseText.split("/");
                expedienteMedico.value = responseSplit[0];
                
                var horaDeCita = document.querySelector("#alertHoraDeCita");
                if(responseSplit[1] == "Matutino") {
                    horaDeCita.innerHTML = "El turno del médico asignado es Matutino(8:00 - 15:00).";
                }
                else {
                    horaDeCita.innerHTML = "El turno del médico asignado es Vespertino(15:00 - 22:00).";
                }
            }
            
            xhr.send()
        }//Fin de obtenerMedicoAsignado
    </script>
   
@endsection