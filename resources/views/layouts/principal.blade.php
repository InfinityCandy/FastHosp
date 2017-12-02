<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('titulo')</title>
        <!-- Web resources -->
        {!!Html::style('//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css')!!}
        <!-- Local resources -->
        {!!Html::style('bootstrap-3.3.7-dist/css/bootstrap.min.css')!!}
        {!!Html::style('css/normalize.css')!!}
        {!!Html::style('icon/css/fontello.css')!!}
        {!!Html::style('css/formStyles.css')!!}
        {!!Html::style('css/main.css')!!}
        {!!Html::style('css/responsive.css')!!}

    </head>
    
    <body>
        <header class="row headerStyle">
            <div class="col-sm-1 col-xs-2 menuContainer">
                <input type="checkbox" id="check">
                <label for="check" class="icon-menu menuIcono"></label>
            </div>
           
            <div class="col-sm-9 col-xs-7">
                    <h1>FastHosp</h1>
            </div>
            
            <div class="col-sm-2 col-xs-3 userIconContainer">
                {{ HTML::image($userImage, 'profile picture', array('class' => 'userIcon', 'id' => 'userIconImage')) }}
                <input type="checkbox" id="checkUserMenu">
                <label for="checkUserMenu"></label>
            </div>
            @section('userMenu')
            
            @show

            @section('opcionesMenu')
            
            @show
        </header>
        <!--<div class="visor"></div>-->
    
        <main class="mainBox">
           <div class="row containerBoxBg">
                <div class="col-xs-12 boxTitle">
                    <h1>@yield('boxTitle')</h1>
                </div>
                @section('principal')
                
                @show
           </div>
            
        </main>
        
        <script>
            var checkBox = document.querySelector("#check");
            var userIconImage = document.querySelector("#userIconImage");
            var visor = document.querySelector(".visor");
            
            checkBox.addEventListener("click", function() {
                if(checkBox.checked == true) {
                    document.querySelector(".menu").style.width = "230px";
                    visor.style.visibility = "visible";
                }
                else {
                    document.querySelector(".menu").style.width = "0px"; 
                    visor.style.visibility = "hidden";
                }
            });
        
            userIconImage.addEventListener("click", function() {
                var checkBoxUserMenu = document.querySelector("#checkUserMenu");
                if(checkBoxUserMenu.checked == false) {
                    checkBoxUserMenu.checked = true;
                    document.querySelector(".userMenuContainer").style.display = "block"
                }
                else {
                    checkBoxUserMenu.checked = false;
                    document.querySelector(".userMenuContainer").style.display = "none"
                }
            })
        </script>
    </body>
</html>