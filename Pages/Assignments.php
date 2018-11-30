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
            <script src="../Resources/Javascript/Expenses/ConsultorExpensesJS.js"></script>
            <meta charset="UTF-8">
            <title>
            </title>
        </head>
        <body>
            <div id="contenedor">
                <div class='titulo'>
                    ASSIGNMENTS
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
                        <div class='aName'>Name</div>
                        <div class='aProj'>Project</div>
                        <div class='aCons'>Consultor</div>
                        <div class='aBR'>BR</div>
                        <div class='aPR'>PR</div>
                        <div class='aPO'>PO</div>
                    </div>
                    <?php
                        if($_SESSION['consultor']['Type'] != '0'){
                            $query =            $connection->query("SELECT a.*, consultors.Firstname, consultors.Lastname, project.Name as pName, po.NoPO
                                                                    FROM assignment a
                                                                    INNER JOIN consultors ON(a.ConsultorID = consultors.ID)
                                                                    INNER JOIN project ON (a.ProjectID = project.ID)
                                                                    INNER JOIN po ON (a.PO = po.ID)
                                                                    WHERE a.ID > 4 AND a.ConsultorID='".$_SESSION['consultor']['ID']."'");
                        }
                        else{
                            $query =            $connection->query("SELECT a.*, consultors.Firstname, consultors.Lastname, project.Name as pName, po.NoPO
                                                                    FROM assignment a
                                                                    INNER JOIN consultors ON(a.ConsultorID = consultors.ID)
                                                                    INNER JOIN project ON (a.ProjectID = project.ID)
                                                                    INNER JOIN po ON (a.PO = po.ID)
                                                                    WHERE a.ID > 4");

                        }
                        while($row = $query->fetch_array()){
                            echo"
                                <div class='contacto'>
                                    <div class='aName' style='cursor: pointer;' ";   if($_SESSION['consultor']['Type'] == '0'){ echo" onclick=\"LoadPage('Administrators/Assignment.php?id=".$row['ID']."');\""; }else{ echo " onclick=\"viewExpense('".$row['ID']."');\""; }   echo">".$row['Name']."</div>
                                    <div class='aProj'>".$row['pName']."</div>
                                    <div class='aCons'>".$row['Firstname']." ".$row['Lastname']."</div>
                                    <div class='aBR'>".$row['BR']."</div>
                                    <div class='aPR'>".$row['PR']."</div>
                                    <div class='aPO'>".$row['NoPO']."</div>
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
