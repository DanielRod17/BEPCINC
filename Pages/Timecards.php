<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
//echo $_SESSION['dataBase']. " ". $_SESSION['loggedin']. " ". $_SESSION['userID']. " ". $_SESSION['userName'];
$IDUsuario =            $_SESSION['consultor']["ID"];
$UserName =             $_SESSION['consultor']["SN"];
include('../Resources/WebResponses/connection.php');
if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true){
?>
    <html>
        <head>
            <link rel="stylesheet" href="../Resources/CSS/Listas_Contenido/Listas_Layout.css">
            <link rel="stylesheet" href="../Resources/CSS/Listas_Contenido/ListasPrincipales_Layout.css">
            <script src="../Resources/Javascript/Timecards/TimecardsJS.js"></script>
            <meta charset="UTF-8">
            <title>
            </title>
        </head>
        <body>
            <div id="contenedor">
                <div class='titulo'>
                    TIMECARDS
                </div>
                <div id="buscador">
                    <div id="searchParams">
                        <div>
                            <div id="image">
                                IMG
                            </div>
                            <div id="banner">
                                Timecards
                            </div>
                            <div id="search">
                                View
                                <select id="parameter">
                                    <option value="1">All</option>
                                    <option value="2">Other</option>
                                </select>
                                <button id="searchButton">Go!</button>
                            </div>
                        </div>
                    </div>
                    <div id="new">
                        <?php if($_SESSION['consultor']['Type'] == '2'){
                        ?>
                            <button id="botonNew" onclick="nuevoTimecard();"><i class="fas fa-plus-circle"></i></button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class='infoTable'>
                    <div class='contacto'>
                        <div class='timeCard'>Timecard ID</div>
                        <div class='resource'>Resource</div>
                        <div class='tProj'>Project</div>
                        <div class='startD'>Start Date</div>
                        <div class='endD'>End Date</div>
                        <div class='status'>Status</div>
                        <div class='totalDays'>Days Worked</div>
                        <div class='totalHours'>Total Hours</div>
                    </div>
                    <?php
                        if($_SESSION['consultor']['Type'] != '0'){
                            $queryDatos =       $connection->query("SELECT t.*, consultors.Firstname as firstN, consultors.Lastname as lastN,  assignment.Name as aName
                                                                    FROM lineas t
                                                                    INNER JOIN consultors ON (consultors.ID = '".$_SESSION['consultor']['ID']."')
                                                                    INNER JOIN assignment ON (t.AssignmentID = assignment.ID)");
                        }
                        else{
                            $queryDatos =       $connection->query("SELECT t.*, consultors.Firstname as firstN, consultors.Lastname as lastN,  assignment.Name as aName
                                                                    FROM lineas t
                                                                    INNER JOIN consultors ON (consultors.ID = t.ConsultorID)
                                                                    INNER JOIN assignment ON (t.AssignmentID = assignment.ID)
                                                                    ");
                        }
                        while($row = $queryDatos->fetch_array()){
                            $id =           $row['ID'];
                            $start =        substr($row['StartingDay'], 0, 10);
                            //$end =          strtotime(str_replace("/","-", $start));
                            $end =          new DateTime($start);
                            $end ->         add(new DateInterval('P6D'));
                            $date =         $end ->format('Y-m-d');
                            $Nombre =       $row['firstN']." ".$row['lastN'];
                            $timeID =       $row['ID'];
                            $hours =        0;
                            $days =         0;


                            for($j = 4 ; $j < 10; $j++){
                                $hours += $row[$j];
                                if(intval($row[$j]) !== 0){
                                    $days++;
                                }
                            }
                            echo"
                                <div class='contacto'>
                                    <div class='timeCard' style='cursor: pointer;' onclick=\"LoadPage('Timecard.php?id=$id');\">".$row['TimecardID']."</div>
                                    <div class='resource'>$Nombre</div>
                                    <div class='tProj'>".$row['aName']."</div>
                                    <div class='startD'>$start</div>
                                    <div class='endD'>$date</div>
                                    <div class='status'>Approved</div>
                                    <div class='totalDays'>$days</div>
                                    <div class='totalHours'>$hours</div>
                                </div>
                           ";
                        }
                    ?>
                </div>
            </div>
        </body>
    </html>
    <?php
}else{
    header("Location: ../index.php");
}
?>
