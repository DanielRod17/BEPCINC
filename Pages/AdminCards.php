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
unset($_SESSION['fecha']);
if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true && $_SESSION['consultor']['Type'] == '0'){
    $queryDel =         $connection->query("DELETE FROM lineas WHERE ConsultorID = '".$_SESSION['consultor']['ID']."' AND TimecardID='1'");
?>
    <html>
        <head>
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            
            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
            
            
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            
            
            <script src="../Resources/Javascript/Timecards/AdminCardsJS.js"></script>
            <link rel="stylesheet" href="../Resources/CSS/Timecards/Timecards_Layout.css">
            <script>
                $( function() {
                    $( "#datepicker" ).datepicker({
                        altFormat: 'yyyy-mm-dd',  // Date Format used
                        firstDay: 0, // Start with Monday
                        beforeShowDay: function(date) {
                            return [date.getDay() === 0,''];
                        }
                    });
                });
            </script>
            <meta charset="UTF-8">
            
            <title>
            </title>
        </head>
        <body>
            <div id='modal'>
                <div id='modalContent' class="modalesCon">
                    <div class='banner'>My Assignments</div>
                    <div class='projectos'>
                        <?php
                            $userID =           $_SESSION['consultor']["ID"];
                            $query =            $connection->query("SELECT Name FROM assignment WHERE ID = (SELECT Assignment FROM consultors WHERE ID='$userID')");
                            if($query -> num_rows > 0){
                                while($row = $query -> fetch_array()){
                                    echo "<div class='projItem' onclick=\"AssignName(this);\" >".$row['Name']."</div>";
                                }
                            }else{
                                echo "No Projects Assigned";
                            }  
                        ?>
                    </div>
                    <div class='banner'>Global Projects</div>
                    <div class='projectos'>
                        <?php
                            $userID =           $_SESSION['consultor']["ID"];
                            $query =            $connection->query("SELECT Name FROM assignment WHERE PO='0'");
                            if($query -> num_rows > 0){
                                while($row = $query -> fetch_array()){
                                    echo "<div class='projItem' onclick=\"AssignName(this);\" >".$row['Name']."</div>";
                                }
                            }else{
                                echo "No Projects Assigned";
                            }  
                        ?>
                    </div>
                    </div>
                    <div id='modalContent2' class="modalesCon">
                        <div class='banner'>Empleados</div>
                        <div class='projectos'>
                            <?php
                                if($_SESSION['consultor']['Type'] == '0'){
                                    $query =            $connection->query("SELECT SN FROM consultors WHERE Type!='0'");
                                    if($query -> num_rows > 0){
                                        while($row = $query -> fetch_array()){
                                            echo "<div class='projItem' onclick=\"AssignName(this);\" >".$row['SN']."</div>";
                                        }
                                    }
                                }  
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contenedor">
                <div class="titulo">Timecards</div>
                <div id ="alertas"></div>
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
                        <button id="botonNew" onclick="nuevoTimecard();"><i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
                <div id="timecards">
                    <div id="tableInfo">
                        <button onclick="weekChange('0');"><<</button><input type="text" id="datepicker" onchange="actualizarTabla(this);" autocomplete="off"><button onclick="weekChange('1');">>></button>
                        <input type='submit' form='timeForms' value='Save'>
                        <button onclick="Approve();" disabled id="approve">Submit</button>
                        <?php
                            if($_SESSION['consultor']['Type'] == '0'){
                                ?>
                                    Source <input type="text" disabled id="sourceEm" onclick="DisplayEmployees()" autocomplete="off">
                                <?php
                            }
                        ?>
                    </div>
                    <table id="timeTable">
                        <thead>
                            <tr>
                                <th class='updateProj'>Project/Assignment</th>
                                <th class="updateDay" id='Mon'>Mon</th>
                                <th class="updateDay" id='Tue'>Tue</th>
                                <th class="updateDay" id='Wed'>Wed</th>
                                <th class="updateDay" id='Thu'>Thu</th>
                                <th class="updateDay" id='Fri'>Fri</th>
                                <th class="updateDay" id='Sat'>Sat</th>
                                <th class="updateDay" id='Sun'>Sun</th>
                                <th>Sum</th>
                                <th>Status</th>
                            </tr>
                            <?php
                                echo "<form id='timeForms' onsubmit='return guardarTimecard();'>";
                                for($i = 1; $i <= 5; $i++){
                                    echo"
                                    <tr class='DaysInput $i'>
                                        <td class='updateProj'>
                                            <i class='icon fas fa-search' onclick=\"DisplayProjects('$i');\" ></i>
                                            <input type='text' class='project $i'></td>
                                        <td class='updateDay'><input type='number' class ='hourDay' min='0' max='24'></td>
                                        <td class='updateDay'><input type='number' class ='hourDay' min='0' max='24'></td>
                                        <td class='updateDay'><input type='number' class ='hourDay' min='0' max='24'></td>
                                        <td class='updateDay'><input type='number' class ='hourDay' min='0' max='24'></td>
                                        <td class='updateDay'><input type='number' class ='hourDay' min='0' max='24'></td>
                                        <td class='updateDay'><input type='number' class ='hourDay' min='0' max='24'></td>
                                        <td class='updateDay'><input type='number' class ='hourDay' min='0' max='24'></td>
                                        <td class='sum'></td>
                                        <td></td>
                                    </tr>";
                                }
                                echo "</form>";
                            ?>
                        </thead>
                    </table>
                </div>
                <div id="bottom">
                    
                </div>
            </div>
        </body>
    </html>
    <?php
}else{
    header("Location: ../index.php");
}
?>