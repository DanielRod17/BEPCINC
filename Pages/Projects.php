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
            <script src="../Resources/Javascript/Project/ProjectsJS.js"></script><meta charset="UTF-8">
            <title>
            </title>
        </head>
        <body>
            <div id="contenedor">
                <div class='titulo'>
                    PROJECTS
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
                        <button id="botonNew" onclick="nuevoTimecard();"><i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
                <div id="projects">
                    <div id="projectTable">
                        <div class="proyecto">
                            <div class="number">&nbsp;</div>
                            <div class="Name">NAME</div>
                            <div class="Sponsor">SPONSOR</div>
                            <div class="Pleader">P. LEADER</div>
                            <div class="Company">COMPANY</div>
                        </div>
                        <?php
                            $query =            $connection->query("SELECT p.*, sponsor.Name as SName, subaccount.Name as sName
                                                                FROM project p
                                                                INNER JOIN sponsor ON( p.SponsorID = sponsor.ID)
                                                                INNER JOIN subaccount ON (subaccount.ManagerID = sponsor.ManagerID)
                                                                WHERE Status='1'");
                            while($row = $query->fetch_array()){
                                echo"
                                    <div class='contacto'>
                                        <div class='number'>".$row['ID']."</div>
                                        <div class='Name projName' id='".$row['ID']."'>".$row['Name']."</div>
                                        <div class='Sponsor'>".$row['SName']."</div>
                                        <div class='Pleader'>".$row['PLeader']."</div>
                                        <div class='Company'>".$row['sName']."</div>
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
