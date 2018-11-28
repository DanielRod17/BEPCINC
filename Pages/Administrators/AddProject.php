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
            <script src="../Resources/Javascript/Project/ProjectJS.js"></script>
            <link href="../Resources/CssAuto/css/jqueryui.css" type="text/css" rel="stylesheet"/>
            <meta charset="UTF-8">
            <title>
            </title>
            <script>
                $( function() {
                    $( "#SDate, #EDate" ).datepicker({
                        altFormat: 'yyyy-mm-dd',  // Date Format used
                        firstDay: 0 // Start with Monday
                    });
                });
            </script>
        </head>
        <body>
            <div id="container">
                <div class="titulo">Add Project</div>
                <div id ="alertas"></div>
                <form id="Project" class="masterForm" onsubmit='return RevisarInfo();'>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Project's Name
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Name' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Sponsor
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Sponsor' required style="width: 50%;" step="0.01">
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Project Leader
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Leader' required style="width: 50%;" >
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Start Date
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='SDate' required style="width: 50%;" step="0.01">
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            End Date
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='EDate' required style="width: 50%;" step="0.01">
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
