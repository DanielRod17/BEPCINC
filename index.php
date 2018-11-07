<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <script src="Resources/Javascript/Login/LoginJS.js"></script>
        <link rel="stylesheet" href="Resources/CSS/Login/Login_Layout.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="contenedor">
            <div id="login">
                <div id="logoAndInfo">
                    <div id="imagenLogo">
                        <img src="Resources/bee logo.png" id="beeLogo">
                    </div>
                    <div id="nombre">
                        <span style="color:  rgb(239, 198, 18); 
                              text-shadow:  1px 0 rgb(239, 198, 18), 0 -1px rgb(239, 198, 18);">BE</span><span style="color:  rgb(49, 63, 94);">TRACKING</span>
                    </div>
                </div>
                <form id="formulario" onsubmit="return Login();">
                    <div class="info">&nbsp;&nbsp;Nombre de Usuario</div>
                    <div class="input"><input type="text" name="username" id="usuario" required></div>
                    <div class="info">&nbsp;&nbsp;Contraseña</div>
                    <div class="input"><input type="password" name="password" id="password" required></div>
                    <div class="input"><input type="submit" value="INICIAR SESION"></div>
                    <div id="recordar"><input type="checkbox" style="float:left; width: 15px; margin-top: -6px;">Recordarme</div>
                    <div id="recuperar" onclick="mostrarRecuperar();">¿Olvidaste tu contraseña?</div>
                </form>
            </div>
            <div id="information">
                <div class="hexagon">
                    <p>
                        En el Cuadrante Mágico de Gartner, se nombró a Salesforce como 
                        líder debido al centro de interacción con el cliente de CRM por 10 años consecutivos
                        <br>
                    </p>
                        <button id="conoceMas">CONOCE MÁS</button>
                </div>
            </div>
            <div id="forgot">
                <form id="enviarRecuperar" onsubmit="return EnviarPassword();">
                    <div class="info"><i class="far fa-envelope"></i>   &nbsp;&nbsp;E-MAIL</div>
                    <div class="input"><input type="text" name="emailRec" id="emailRec" required></div>
                    <div class="input"><input type="submit" value="SEND"></div>
                </form>
            </div>
        </div>
    </body>
</html>
