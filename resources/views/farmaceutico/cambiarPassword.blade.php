@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.farmaceuticoMenu')
    
@endsection

@section('userMenu')

    @include('layouts.farmaceuticoUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Cambiar Contraseña')
    <form method="post" action="../farmaceuticoCambiarPassword" onsubmit="return validar()">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">       
        <fieldset class="form-style-5">
            
            <div class="col-md-4 col-md-offset-4 form-group">
                <label for="oldPassword">Contraseña actual:</label>
                <input class="form-control" type="password" name="oldPassword" id="oldPassword">
            </div>
        
            <div class="col-md-4 col-md-offset-4 form-group">
                <label for="newPassword">Nueva contraseña:</label>
                <input class="form-control" type="password" name="newPassword" id="newPassword">
            </div>
        
            <div class="col-md-4 col-md-offset-4 form-group">
                <label for="newPasswordVerify">Repita la nueva contraseña:</label>
                <input class="form-control" type="password" name="newPasswordVerify" id="newPasswordVerify">
            </div>

            <div class="col-md-offset-1 col-sm-10 changePasswordButton">
                <input id="submit" type="submit" value="Eviar"> 
            </div>
            
            <div class="col-md-offset-1 col-sm-10">
                <h3 id="errorTextChangePass" class="error">{{$error}}</h3>
            </div>
         </fieldset>
        </form>
        
        <script>
            function validar() {
                var oldPassword = document.querySelector("#oldPassword");
                var newPassword = document.querySelector("#newPassword");
                var newPasswordVerify = document.querySelector("#newPasswordVerify");
                
                var flag = false;
            
                if(oldPassword.value == "") {
                    document.querySelector("#errorTextChangePass").innerHTML = "Erro: Escriba su contraseña actual.";
                    flag = false;
                }
                else {
                    if(newPassword.value == "") {
                        document.querySelector("#errorTextChangePass").innerHTML = "Erro: La nueva contraseña no puede estar en blanco.";
                        flag = false;
                    }
                    else {
                        if(newPassword.value == newPasswordVerify.value) {
                            document.querySelector("#errorTextChangePass").innerHTML = "";
                            flag = true;
                        }
                        else {
                            document.querySelector("#errorTextChangePass").innerHTML = "Erro: Las contraseñas no  coinciden.";
                            flag = false;  
                        }
                    }
                } 
                
                if(flag == true) {
                    return true;
                }
                else {
                    return false;
                }
            }
        </script>
@endsection