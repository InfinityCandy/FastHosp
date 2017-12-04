@extends('layouts.principal')


@section('titulo', 'Consulta')

@section('opcionesMenu')
   
    @include('layouts.medicoFamiliarMenu')
    
@endsection

@section('userMenu')

    @include('layouts.medicoFamiliarUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Consulta')
   <form method="post" action="../finalizarConsulta" enctype="multipart/form-data">
      
       <input type="hidden" name="_token" value="{!! csrf_token() !!}">
       <input type="hidden" name="expedientePaciente" id="expedientePaciente" value="{{$pacienteInfo->pacienteExpediente}}">
              
       <fieldset class="form-style-5">
           <div class="col-sm-4 consultaUserImageContainer">
               <img src="{{'../storage/'.$pacienteInfo->foto}}" class="consultaUserImage">
           </div> 
  
           <div class="userBasicInfo">
               <div class="col-sm-4">
                   <h4><strong>Expediente del paciente:</strong> {{$pacienteInfo->pacienteExpediente}}</h4>
               </div>
               <div class="col-sm-4">
                   <h4><strong>Nombre del paciente:</strong> {{$pacienteInfo->nombre." ".$pacienteInfo->apellido}}</h4>
               </div>

               <div class="col-sm-3">
                   <h4><strong>Edad:</strong> {{$pacienteInfo->edad}}</h4>
               </div>

               <div class="col-sm-2">
                   <h4><strong>Tipo de sangre:</strong> {{$pacienteInfo->tipoDeSangre}}</h4>
               </div>

               <div class="col-sm-3">
                   <h4><strong>Estado Civil:</strong> {{$pacienteInfo->estadoCivil}}</h4>
               </div>

               <div class="col-sm-3">
                   <h4><strong>Tipo de Afiliación:</strong> {{$pacienteInfo->tipoDeAfiliacion}}</h4>
               </div>
           </div>
           
           <div class="col-md-2 form-group">
               <label for="peso">Peso corporal</label>
               <input class="form-control" type="text" name="peso" id="peso" placeholder="Ejemplo: 80kg" required>
           </div>
           
           <div class="col-md-3 form-group">
               <label for="altura">Altura</label>
               <input class="form-control" type="text" name="altura" id="altura" placeholder="Ejemplo: 1.80m" required>
           </div>
           
           <div class="col-md-3 form-group">
               <label for="peso">Presión Arterial</label>
               <input class="form-control" type="text" name="presion" id="presion" placeholder="Ejemplo: 119/79" required>
           </div>
           
           <div class="col-md-5 form-group">
               <label for="temperaturaCorporal">Temperatura Corporal</label>
               <input class="form-control" type="text" name="temperaturaCorporal" id="temperaturaCorporal" placeholder="Ejemplo: 37°" required>
           </div>
           
           <div class="col-md-4 form-group">
               <label for="alergiaAMedicamentos">Medicamentos a los que presenta alergia</label>
               <textarea class="form-control" type="text" name="alergiaAMedicamentos" id="alergiaAMedicamentos" required rows="4">{{$pacienteInfo->alergiaAMedicamentos}}</textarea>
           </div>
           
           <div class="col-md-4 form-group">
               <label for="adicciones">Adiciones que presenta</label>
               <textarea class="form-control" type="text" name="adicciones" id="adicciones" required rows="4">{{$pacienteInfo->adicciones}}</textarea>
           </div>
           
            <div class="col-md-4 form-group">
               <label for="condiciones">Condiciones que presenta</label>
               <textarea class="form-control" type="text" name="condiciones" id="condiciones" required rows="4">{{$pacienteInfo->condiciones}}</textarea>
           </div>
           
           <div class="col-md-12">
               <h2>Historial Clinico de Paciente</h2>
           </div>
           <div class="col-md-12 historiaClinica">              
               @foreach ($historiaClinica as $historia)
                  @foreach ($historia as $elemento )
                   <p id="historiaClinica">{{$elemento}}</p>
                  @endforeach
                  <br>
               @endforeach
               
               <h3>Información de última consulta</h3>
               <p><strong>Peso: </strong>{{$pacienteInfo->peso}}</p>
               <p><strong>Altura: </strong>{{$pacienteInfo->altura}}</p>
               <p><strong>Presión Arterial: </strong>{{$pacienteInfo->presionArterial}}</p>
               <p><strong>Temperatura Corporal: </strong>{{$pacienteInfo->temperaturaCorporal}}</p>
           </div>
           
           <div class="col-md-12">
               <h2>Indicaciones de Consulta</h2>
           </div>
           <div class="col-md-3">
               <label for="fechaDeConsulta">Fecha de consulta</label>
               <input class="form-control" type="date" name="fechaDeConsulta" id="fechaDeConsulta" required>
           </div>
           
           <div class="col-md-12 form-group">
               <label for="razonDeConsulta">Razón de consulta</label>
               <textarea class="form-control" type="text" name="razonDeConsulta" id="razonDeConsulta" required rows="2" placeholder="Razón por la cual el paciente acudio a consulta"></textarea>
           </div>
           
           <div class="col-md-12 form-group">
               <label for="diagnosticoMedico">Diagnostico médico</label>
               <textarea class="form-control" type="text" name="diagnosticoMedico" id="diagnosticoMedico" required rows="5" placeholder="El diagnostico del médico"></textarea>
           </div>
           
           <div class="col-md-12 form-group">
               <label for="indicaciones">Indicaciones</label>
               <textarea class="form-control" type="text" name="indicaciones" id="indicaciones" required rows="2" placeholder="Reposo, ingesta de liquidos, diesta blanda"></textarea>
           </div>
           
           <div class="col-md-12 form-group">
               <label for="medicamentosIndicados">Medicamentos indicados</label>
               <textarea class="form-control" type="text" name="medicamentosIndicados" id="medicamentosIndicados" rows="4" placeholder="Medicamento, dosis, duración (Dejar en blanco si no se ha recetado medicamento)"></textarea>
           </div>
           
            <div class="col-md-3 form-group">
                <label for="canalizarPaciente">Canalizar Paciente</label>
                <select class="form-control" name="canalizarPaciente" id="canalizarPaciente">
                    <option value="No">No</option>
                    <option value="Si">Sí</option>
                </select>
            </div>
            
            <div class="col-md-5 form-group especialidadCanalizarContainer">
                <label for="especialidadCanalizar">Especialidad</label>
                <select class="form-control" name="especialidadCanalizar" id="especialidadCanalizar">
                    <option value="1">Cardiología</option>                   
                    <option value="3">Dermatología</option>
                    <option value="4">Traumatología</option>                                    
                    <option value="5">Epidemiología</option>                    
                    <option value="6">Gastroenterología</option>
                    <option value="7">Hematología</option>
                    <option value="8">Oncología</option>
                    <option value="9">Neurlogía</option>
                    <option value="10">Urología</option>
                </select>
            </div>
           
           <div class="col-sm-12 sumbmitButtonCotainer">
                <input type="submit" value="Terminar Consulta"> 
                <p id="serverError" class="error"></p>
            </div>
       </fieldset>

       
   </form>
   
   <script>
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth()+1;
        var y = date.getFullYear();
       
        if(d < 10) {
            d = "0"+d;
        }
                
        var fecha = y+"-"+m+"-"+d;
       
        var fechaDeConsulta = document.querySelector("#fechaDeConsulta");
        fechaDeConsulta.value = fecha;
       
        var canalizarPaciente = document.querySelector("#canalizarPaciente");
        
        canalizarPaciente.addEventListener("change", function() {
            if(canalizarPaciente.value == "Si") {
                 document.querySelector(".especialidadCanalizarContainer").style.display = "block";
            }
            else {
                document.querySelector(".especialidadCanalizarContainer").style.display = "none";
            }
        });
   </script>
   
@endsection