@extends('layouts.principal')


@section('titulo', 'Inicio')

@section('opcionesMenu')
   
    @include('layouts.medicoFamiliarMenu')
    
@endsection

@section('userMenu')

    @include('layouts.medicoFamiliarUserMenu')

@endSection


@section('principal')
   @section('boxTitle', 'Bienvenido')
   <div class="col-xs-12">
       <div class="mainLogoContainer">
           <img src="../img/logo-hospital.png" class="mainLogo">
           <img src="../img/min-logo-hospital.png" class="minMainLogo">
       </div>
   </div>
   
   <script>
        function setLogo() {      
            var windowWidth = window.innerWidth;
            if(windowWidth <= 487) {
                document.querySelector(".mainLogo").style.display = "none";
                document.querySelector(".minMainLogo").style.display = "block";
            }
            else {
                document.querySelector(".mainLogo").style.display = "block";
                document.querySelector(".minMainLogo").style.display = "none";
            }
        }
            
        window.addEventListener("resize", setLogo);
   </script>
   
@endsection