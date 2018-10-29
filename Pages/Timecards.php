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
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");
if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true){
?>
    <html>
        <head>
            <script src="../Resources/Javascript/Timecards/TimecardsJS.js"></script>
            <link rel="stylesheet" href="../Resources/CSS/Timecards/Timecards_Layout.css">
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <meta charset="UTF-8">
            <title>
            </title>
        </head>
        <body>
            <div id="contenedor">
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
                    </div>
                    <table id="timeTable">
                        <thead>
                            <tr>
                                <th>Timecard ID</th>
                                <th>Resource</th>
                                <th>Project</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Total Days Worked</th>
                                <th>Total Hours</th>
                            </tr>
                        </thead>
                        <?php
                            $query =            $connection->query("SELECT * FROM timecards WHERE ConsultorID='".$_SESSION['consultor']['ID']."'");
                            while($row = $query->fetch_array()){
                                $id =           $row['ID'];
                                echo"
                                   <tr>
                                       <td>".$row['Name']."</td>
                                       <td>Herr Señores</td>
                                       <td>Venta de Materiales</td>
                                       <td>30-10-2018</td>
                                       <td>02-11-2018</td>
                                       <td>Approved</td>
                                       <td>3</td>
                                       <td>27</td>
                                   </tr>
                               ";   
                            }
                        ?>
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