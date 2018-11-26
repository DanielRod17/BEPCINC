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
            <link rel="stylesheet" href="../Resources/CSS/MasterCSS.css">
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

            <script src="../Resources/Javascript/Assignment/AssignmentJS.js"></script>
            <link href="../Resources/CssAuto/css/jqueryui.css" type="text/css" rel="stylesheet"/>
            <meta charset="UTF-8">
            <title>

            </title>
        </head>
        <body>
            <div id="container">
                <div class="titulo">Add Assignment</div>
                <div id ="alertas"></div>
                <form id="Assignment" class='masterForm' onsubmit='return RevisarInfo();'>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Assignment's Name
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Name' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Project
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Project' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            PO
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='PO' required style="width: 50%;" step="0.01">
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Employee
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Employee' required style="width: 50%;">
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder2">
                            BR
                        </div>
                        <div class="plaecHolder2">
                            PR
                        </div>
                        <div class="entrada2">
                            <input type='number' class='unico' id='BR' required style="width: 50%;" step="0.01">
                        </div>
                        <div class="entrada2">
                            <input type='number' class='unico' id='PR' required style="width: 50%;" step="0.01">
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
