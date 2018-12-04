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
include('../../Resources/WebResponses/connection.php');
if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true){
?>
    <html>
        <head>
            <link rel="stylesheet" href="../Resources/CSS/Listas_Contenido/Listas_Layout.css">
            <link rel="stylesheet" href="../Resources/CSS/Listas_Contenido/ListasPrincipales_Layout.css">
            <script src="../../Resources/Javascript/AccountsJS.js"></script><meta charset="UTF-8">
            <title>
            </title>
        </head>
        <body>
            <div id="contenedor">
                <div class='titulo'>
                    POs
                </div>
                <div id="buscador">
                    <div id="searchParams">
                        <div>
                            <div id="image">
                                IMG
                            </div>
                            <div id="banner">
                                Projects
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
                        <button id="botonNew" onclick="LoadPage('Administrators/AddPO.php');"><i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
                <div id="pos">
                    <div id="poTable">
                        <div class="proyecto">
                            <div class="number">&nbsp;</div>
                            <div class="poNumber">PO Number</div>
                            <div class="poProject">Project</div>
                            <div class="poAmmount">Ammount</div>
                            <div class="poCurrency">Currency</div>
                            <div class="poStatus">Status/Type</div>
                        </div>
                        <?php
                            $query =            $connection->query("SELECT p.*, project.Name as pName, assignment.ProjectID as aID
                                                                    FROM po p
                                                                    INNER JOIN assignment ON (assignment.PO = p.ID)
                                                                    INNER JOIN project ON (project.ID = assignment.ProjectID)
                                                                    WHERE p.Status='1'
                                                                    GROUP BY project.Name");
                            while($row = $query->fetch_array()){
                                if($row['Currency'] == '0')
                                    $currency =       "MXN";
                                else
                                    $currency =       "USD";

                                if($row['Status'] == '0')
                                    $status =         "Inactive";
                                else if($row['Status'] == '1')
                                    $status =         "Active";
                                else
                                    $status =         "Temporal";
                                echo"
                                    <div class='contacto'>
                                        <div class='number'>".$row['ID']."</div>
                                        <div class='poNumber' onclick=\"LoadPage('Administrators/PO.php?id=".$row['ID']."');\" >".$row['NoPO']."</div>
                                        <div class='poProject'>".$row['pName']."</div>
                                        <div class='poAmmount'>$".$row['Ammount']."</div>
                                        <div class='poCurrency'>".$currency."</div>
                                        <div class='poStatus'>$status</div>
                                    </div>
                                ";
                                //echo "<div class='contactoInfo'></div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
}else{
    header("Location: ../index.php");
}
?>
