@extends('layouts.principal')


@section('titulo', 'Registrar Paciente')

@section('opcionesMenu')
   
    @include('layouts.administrativoGeneralMenu')
    
@endsection

@section('userMenu')

     @include('layouts.administrativoGeneralUserMenu')

@endSection


@section('principal')
    @section('boxTitle', 'Registrar Paciente')
    
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
    @endif
    
    <form method="post" action="../administrarPacientes" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">       
        <fieldset class="form-style-5">
        
        <div class="col-md-4 imagePreviewContainer" id="file-preview-zone"></div>
        
        <div class="col-md-3 form-group">
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="José Angel" required>
        </div>
        
        <div class="col-md-5 form-group">
            <label for="apellidos">Apellidos</label>
            <input class="form-control" type="text" name="apellidos" id="apellidos" placeholder="Appellido Paterno Appellido Materno. Ejemplo: Rosales Rocha" required>
        </div>
        
        <div class="col-md-3 form-group">
            <label for="FechaDeNacimiento">Fecha de nacimiento</label>
            <input class="form-control" type="date" name="FechaDeNacimiento" id="fechaDeNacimiento" required>
        </div>
        
        <div class="col-md-2 form-group">
            <label for="edad">Edad</label>
            <input class="form-control" type="text" name="edad" id="edad" required>
        </div>
        
        <div class="col-md-3 form-group">
            <label for="tipoDeSangre">Tipo de Sangre</label>
            <select class="form-control" name="tipoDeSangre" id="TipoDeSangre">
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>
        
        <div class="col-md-3 form-group">
            <label for="email">Correo electrónico</label>
            <input class="form-control" type="text" name="email" id="email" placeholder="Ejmplo: correo@ejemplo.com" required>
        </div>
        
        <div class="col-md-2 form-group">
            <label for="estadoCivil">Estado civil</label>
            <select class="form-control" name="estadoCivil" id="estadoCivil">
                <option value="Soltero/a">Soltero/a</option>
                <option value="Comprometido/a">Comprometido/a</option>
                <option value="Casado/a">Casado/a</option>
                <option value="Divorciado/a">Divorciado/a</option>
                <option value="Viudo/a">Viudo/a</option>
            </select>
        </div>
        
        <div class="col-md-3 form-group">
            <label for="GradoDeEstudios">Grado de estudios</label>
            <select class="form-control" name="GradoDeEstudios" id="GradoDeEstudios">
                <option value="Sin estudios">Sin estudios</option>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
                <option value="Bachillerato">Bachillerato</option>
                <option value="Técnico">Técnico</option>
                <option value="TSU">TSU</option>
                <option value="Universidad">Universidad</option>
                <option value="Maestria">Maestria</option>
                <option value="Doctorado">Doctorado</option>
            </select>
        </div>
        
        <div class="col-md-4 form-group">
            <label for="ocupacion">Ocupación</label>
            <input class="form-control" type="text" name="ocupacion" id="ocupacion" required>
        </div>
        
        <div class="col-md-4 form-group">
            <label for="lugarDeNacimientoPais">Lugar de nacimiento: Pais</label>
            <input class="form-control" type="text" name="lugarDeNacimientoPais" id="lugarDeNacimientoPais" required>
        </div>
        
        <div class="col-md-4 form-group">
            <label for="lugarDeNacimientoEstado">Lugar de nacimiento: Estado</label>
            <input class="form-control" type="text" name="lugarDeNacimientoEstado" id="lugarDeNacimientoEstado">
        </div>
        
        <div class="col-md-4 form-group">
            <label for="direccion">Dirección de residencia</label>
            <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Pais, Estado, ciudad, calle" required>
        </div>
        
        <div class="col-md-3 form-group">
            <label for="telefono">Teléfono celular o fijo</label>
            <input class="form-control" type="text" name="telefono" id="telefono" required>
        </div>
        
        <div class="col-md-3 form-group">
            <label for="personaDeConfianza1">Nombre de persona de confiaza1</label>
            <input class="form-control" type="text" name="personaDeConfianza1" id="personaDeConfianza1">
        </div>
        
        <div class="col-md-3 form-group">
            <label for="personaDeConfianza1">Teléfono de persona de confiaza1</label>
            <input class="form-control" type="text" name="telefonoPersonaDeConfianza1" id="telefonoPersonaDeConfianza1" required>
        </div>
        
        <div class="col-md-3 form-group">
            <label for="personaDeConfianza2">Nombre de persona de confiaza2</label>
            <input class="form-control" type="text" name="personaDeConfianza2" id="personaDeConfianza2" required>
        </div>
        
        <div class="col-md-3 form-group">
            <label for="personaDeConfianza2">Teléfono de persona de confiaza2</label>
            <input class="form-control" type="text" name="telefonoPersonaDeConfianza2" id="telefonoPersonaDeConfianza2" required>
        </div>
    
        
        <div class="col-md-3 form-group">
            <label for="tipoDeAfiliacion">Tipo de afiliación</label>
            <select class="form-control" id="tipoDeAfiliacion" name="tipoDeAfiliacion">
                <option value="Trabajador">Trabajador</option>
                <option value="Padre/Madre">Padre/Madre</option>
                <option value="Hijo/a">Hijo/a</option>
                <option value="Hermano/a">Hermano/a</option>
            </select>
        </div>
        
        <!--<div class="col-md-3 form-group expedienteDelTrabajadorContainer">
            <label for="expedienteDelTrabajador">Expediente del trabajador afiliado</label>
            <input class="form-control" type="text" name="expedienteDelTrabajador" id="expedienteDelTrabajador">
        </div>-->
        
        <div class="col-md-3 form-group">
            <label for="foto">Foto: </label>
            <input  type="file" name="foto" id="foto" accept="image/*" required>
        </div>
        
        <div class="col-sm-12">
            <input type="submit" value="Registrar"> 
        </div>
        </fieldset> 
        
    </form>
    
    <script>
        var fechaNacimiento = document.querySelector("#fechaDeNacimiento");
       /* var tipoAfiliacion = document.querySelector("#tipoDeAfiliacion");
        
        tipoAfiliacion.addEventListener("change", function() {
            if(tipoAfiliacion.value != "Trabajador") {
                 document.querySelector(".expedienteDelTrabajadorContainer").style.display = "block";;
            }
            else {
                document.querySelector(".expedienteDelTrabajadorContainer").style.display = "none";
            }
        });*/
        
        fechaNacimiento.addEventListener("change", function() {
            var fechaN = fechaNacimiento.value;
            var fechaN = fechaN.split("-");
            
            document.querySelector("#edad").setAttribute("value", calculateCurrentAge(fechaN) + " años");
        });
        
        var fileUpload = document.getElementById('foto');
        fileUpload.addEventListener("change", function(e) {
            readFile(e.target);
        });
        
        function calculateCurrentAge(birthDay) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth()+1;
            var year = date.getFullYear();
            
            var age = year - parseInt(birthDay[0]);
            
            if(parseInt(birthDay[1]) > month) {
                age = age - 1;
            }
            else {
                if(parseInt(birthDay[2]) > day && parseInt(birthDay[1]) == month) {
                    age = age - 1;
                }  
            }
            return age;   
        } //Fin de calculateCurrentAge
        
        var flag; //Variable auxiliar que nos ayuda a saber si hay una imagen cargada en la vista previa o no
        function readFile(input) {
            var previewZone = document.getElementById('file-preview-zone');
            
            //Sí no se selecciona imagen y ya hay una cargada en la vista previa la quitamos
            if(input.files.length == 0 && flag == true) {
                previewZone.removeChild(previewZone.firstChild); 
                flag = false; //Indicamos que ya no hay imagen en la vista previa
            }
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var filePreview = document.createElement('img');

                    filePreview.id = 'file-preview';
                    filePreview.src = e.target.result;
                    filePreview.classList.add('imagePreview');

                    //Sí se selecciona otra imagen y ya hay una en la vista previa la quitamos para poder poner la nueva
                    if(flag == true) {
                        previewZone.removeChild(previewZone.firstChild); 
                    }
                    
                    previewZone.appendChild(filePreview);
                    flag = true;//Indicamos que hay una imagen cargada en la vista previa
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        } //Fin de readFile

    </script>
@endsection