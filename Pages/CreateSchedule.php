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

include('../Resources/WebResponses/connection.php');
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
            
            <script src="../Resources/Javascript/CreateSchedule/ScheduleJS.js"></script>
            <link href="../Resources/CssAuto/css/jqueryui.css" type="text/css" rel="stylesheet"/>
            <meta charset="UTF-8">
            <title>

            </title>
        </head>
        <body>
            <div id="container">
                <div class="titulo">Create Schedule</div>
                <div id ="alertas"></div>
                <form id="Schedule" class="masterForm" onsubmit='return RevisarInfo();'>
                    <div class="Linea" style="margin-top: 30px;">
                        <div class="plaecHolder" style="margin-bottom: 20px;">
                            Schedule's Name
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Nombre' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder2">
                            Country
                        </div>
                        <div class="plaecHolder2">
                            State
                        </div>
                        <div class="entrada2">
                            <select class="unico" id='Country' onchange='EnableStates(this.value);'>
                                <option value="MX">MX</option>
                                <option value="US">US</option>
                            </select>
                        </div>
                        <div class="entrada2">
                             <select class="unico" id='State' disabled>
                                <?php
                                    $query =  $connection->query("SELECT name FROM states");
                                    while($row = $query->fetch_array()){
                                        $name =     $row['name'];
                                        echo "<option value='$name'>$name</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="Linea" style="margin-top: 30px;">
                        <div class="plaecHolder" style="margin-bottom: 20px;">
                            Daily Hours
                        </div>
                        <div class="entrada">
                            <div class='day'>
                                <div class='tag'>
                                    Sunday
                                </div>
                                <div class='inpTag'>
                                    <input type='number' class='dayNum' max='24' min='1'>
                                </div>
                            </div>
                            <div class='day'>
                                <div class='tag'>
                                    Monday
                                </div>
                                <div class='inpTag'>
                                    <input type='number' class='dayNum' max='24' min='1'>
                                </div>
                            </div>
                            <div class='day'>
                                <div class='tag'>
                                    Tuesday
                                </div>
                                <div class='inpTag'>
                                    <input type='number' class='dayNum' max='24' min='1'>
                                </div>
                            </div>
                            <div class='day'>
                                <div class='tag'>
                                    Wednesday
                                </div>
                                <div class='inpTag'>
                                    <input type='number' class='dayNum' max='24' min='1'>
                                </div>
                            </div>
                            <div class='day'>
                                <div class='tag'>
                                    Thursday
                                </div>
                                <div class='inpTag'>
                                    <input type='number' class='dayNum' max='24' min='1'>
                                </div>
                            </div>
                            <div class='day'>
                                <div class='tag'>
                                    Friday
                                </div>
                                <div class='inpTag'>
                                    <input type='number' class='dayNum' max='24' min='1'>
                                </div>
                            </div>
                            <div class='day'>
                                <div class='tag'>
                                    Saturday
                                </div>
                                <div class='inpTag'>
                                    <input type='number' class='dayNum' max='24' min='1'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Linea" style='margin-top:   90px;'>
                        <div class="plaecHolder2">
                            Double After
                        </div>
                        <div class="plaecHolder2">
                            Triple After
                        </div>
                        <div class="entrada2">
                            <div class='inpTag' style='width: 80px;'>
                                <input id="doubleAf" type='number' class='dayNum' min='1'>
                            </div>
                        </div>
                        <div class="entrada2">
                            <div class='inpTag' style='width: 80px;'>
                                <input id="tripleAf" type='number' class='dayNum' min='1'>
                            </div>
                        </div>
                    </div>
                    <div class="Linea" style="margin-bottom: 30px; margin-top: 90px;">
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
