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
    <body onload="changeBackground();">
        <div id="contenedor">
            <div id="login">
                <img id="logo" src="Resources/bepclogo.png">
                <form id="formulario" onsubmit="return Login();">
                    <div class="info"><i class="fas fa-user"></i>   &nbsp;&nbsp;USERNAME</div>
                    <div class="input"><input type="text" name="username" id="usuario" required></div>
                    <div class="info"><i class="fas fa-lock"></i>   &nbsp;&nbsp;PASSWORD</div>
                    <div class="input"><input type="password" name="password" id="password" required></div>
                    <div class="input"><input type="submit" value="LOGIN"></div>
                </form>
                <label id="recuperar" onclick="mostrarRecuperar();">Forgot your password? ></label>
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
