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
                    EXPENSES
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
                        <div class='eName'>Expense Name</div>
                        <div class='eTName'>Travel</div>
                        <div class='eCName'>Consultor</div>
                        <div class='eCategory'>Category</div>
                        <div class='eSubmitD'>Submit Date</div>
                        <div class='eQty'>Qty</div>
                        <div class='eStatus'>Status</div>
                    </div>
                    <?php
                        if($_SESSION['consultor']['Type'] != '0'){
                            $query =            $connection->query("SELECT e.*, travels.Name as TName, consultors.Firstname, consultors.Lastname, expensecategory.Name as eName
                                                                    FROM expenses e
                                                                    INNER JOIN travels ON(e.TravelID = travels.ID)
                                                                    INNER JOIN consultors ON(travels.ConsultorID = consultors.ID)
                                                                    INNER JOIN expensecategory ON (expensecategory.ID = e.Category)
                                                                    WHERE TravelID IN (SELECT ID FROM travels WHERE ConsultorID='".$_SESSION['consultor']['ID']."')");
                        }
                        else{
                            $query =            $connection->query("SELECT e.*, travels.Name as TName, consultors.Firstname, consultors.Lastname, expensecategory.Name as eName
                                                                    FROM expenses e
                                                                    INNER JOIN travels ON(e.TravelID = travels.ID)
                                                                    INNER JOIN consultors ON(travels.ConsultorID = consultors.ID)
                                                                    INNER JOIN expensecategory ON (expensecategory.ID = e.Category)");

                        }
                        while($row = $query->fetch_array()){
                            echo"
                                <div class='contacto'>
                                    <div class='eName' style='cursor: pointer;' ";   if($_SESSION['consultor']['Type'] == '0'){ echo" onclick=\"editTimecard('');\""; }else{ echo " onclick=\"viewTimecard('');\""; }   echo">".$row['Name']."</div>
                                    <div class='eTName'>".$row['TName']."</div>
                                    <div class='eCName'>".$row['Firstname']." ".$row['Lastname']."</div>
                                    <div class='eCategory'>".$row['eName']."</div>
                                    <div class='eSubmitD'>".substr($row['SubmitDate'], 0, 10)."</div>
                                    <div class='eQty'>".$row['Quantity']."</div>
                                    <div class='eStatus'>".$row['Status']."</div>
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
