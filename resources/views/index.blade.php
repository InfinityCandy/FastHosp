<!DOCTYPE html>
<html>
   
    <head>
        <meta charset="utf-8">
        <title>FastHost</title>
        <!-- Web resources -->
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <!-- Local resources -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/normalize.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/indexLogin.css" rel="stylesheet">

    </head>
    
    <body onload="setCoverSize">
        <header class="row headerStyle">
                <div id=wrap class="col-md-3">
                    <h1>FastHosp</h1>
            </div>
        </header>
    
        <main class="coverImage">
           <div class="coverImageText">
            <h2>Iniciar sesión</h2>
            <form class="form-5 clearfix" method="post" action="login">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <p>
                    <input id="expediente" name="expediente" placeholder="Epediente" type="text">
                    <input name="password" id="password" placeholder="Contraseña" type="password"> 
                </p>
                <button type="submit" name="submit">
    	            <i class="icon-arrow-right"></i>
    	            <span>Sign in</span>
                </button>     
            </form>
            </div>
            <div class="errorContainer">
                @if (session('errorMessage'))
                    <h3 class="error">{{ session('errorMessage') }}</h3>
                @endif
            </div>
        </main>
        
        <br/>
        
        <section class="row informationSection">
            <div class="col-md-12 informationSectionTitle ">
                <h1>Sistema de gestión hospitalaria</h1>
            </div>
          
            <div class="col-md-4 informationSectionBoxes">
                <h3><strong>Agilización de la transferencia de información</strong></h3>
                <p>Sistema de gestión para el control efectivo de la información. Agiliza la transeferencia de información entre las diversas áreas que integran el hospital y alamacena dicha información de manera digital para mantener un registro.</p>
            </div>
            
            
            <div class="col-md-4 informationSectionBoxes">
                <h3><strong>Integración de la información hospitalaria</strong></h3>
                <p>El sistema FastHosp integra toda la información del hospital de tal manera que facilita el mantenimiento y acceso a la misma por parte del personal administrativo y no administrativo registrado dentro del sistema del hospital.</p>
            </div>
            
            
            <div class="col-md-4 informationSectionBoxes">
                <h3><strong>Mejor comunicación entre departamentos</strong></h3>
                <p>El sistema FastHosp facilita el intercambio de información entre las diversas áreas que integran el hospital, disminuyendo notablemente los tiempo de respuesta de cada una de las áreas involucradas.</p>
            </div>
        
        </section>
        
        <br/>
        
        <footer class="footerStyle">
            <p>&copy; 2017 Luis Alejandro Salazar Rangel</p>
        </footer>
        
        <script>
            function setCoverSize() {
				var windowHeight = window.innerHeight;
                document.querySelector(".coverImage").style.height = windowHeight + "px";
            }
            
            window.addEventListener("resize", setCoverSize());
        </script>
    </body>
    
</html>