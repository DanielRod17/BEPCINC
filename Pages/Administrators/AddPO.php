<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 //
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
            <script src="../Resources/Javascript/PoJS.js"></script>
            <link href="../Resources/CssAuto/css/jqueryui.css" type="text/css" rel="stylesheet"/>
            <meta charset="UTF-8">
            <title>

            </title>
        </head>
        <body>
            <div id="container">
                <div class="titulo">Add PO</div>
                <div id ="alertas"></div>
                <form id="PO" class="masterForm" onsubmit='return RevisarInfo();'>
                    <div class="Linea">
                        <div class="plaecHolder">
                            PO Number
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Number' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Ammount
                        </div>
                        <div class="entrada">
                            <input type='number' class='unico' id='Ammount' required style="width: 50%;" step="0.01">
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Currency
                        </div>
                        <div class="entrada">
                            <select id='currency' class='unico'>
                                <option value='0'>MXN</option>
                                <option value='1'>USD</option>
                            </select>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Status
                        </div>
                        <div class="entrada">
                            <select id='status' class='unico'>
                                <option value='0'>INACTIVE</option>
                                <option value='1'>ACTIVE</option>
                                <option value='2'>TEMPORAL</option>
                            </select>
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
