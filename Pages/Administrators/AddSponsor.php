<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($_SESSION))
{
    session_start();
}

include('../../Resources/WebResponses/connection.php');
$IDUsuario =            $_SESSION['consultor']["ID"];
$UserName =             $_SESSION['consultor']["SN"];
if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true && $_SESSION['consultor']['Type'] == '0'){
    ?>
    <html>
        <head>
            <link href="../Resources/CssAuto/css/jqueryui.css" type="text/css" rel="stylesheet"/>
            <link rel="stylesheet" href="../Resources/CSS/MasterCSS.css">
            <script src="../Resources/Javascript/SponsorJS.js"></script>
            <meta charset="UTF-8">
            <title>

            </title>
        </head>
        <body>
            <div id="container">
                <div class="titulo">Add Sponsor</div>
                <div id ="alertas"></div>
                <form id="Sponsor" class="masterForm" onsubmit='return RevisarInfo();'>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Sponsor's Name
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Name' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Email
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Email' required style="width: 50%;" step="0.01">
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Phone
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Phone' required style="width: 50%;" step="0.01">
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Manager's Name
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='MName' style="width: 50%;" >
                        </div>
                    </div>
                    <div class="Linea" style="margin-bottom: 30px;">
                        <div class="entrada">
                            <input type='submit' value='Submit' id='submittir'>
                        </div>
                    </div>
                </form>
            </div>
        </body>
    </html>
    <?php
}else{
    header("Location: Dashboard.php");
}
