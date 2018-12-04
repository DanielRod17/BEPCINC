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
                    ACCOUNTS
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
                        <button id="botonNew" onclick="LoadPage('Administrators/AddAccount.php');"><i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
                <div id="pos">
                    <div id="poTable">
                        <div class="proyecto">
                            <div class="number">&nbsp;</div>
                            <div class="accName">Name</div>
                            <div class="accIndustry">Industry</div>
                            <div class="accAddress">Address</div>
                            <div class="accCompany">Company</div>
                            <div class="accManager">Manager</div>
                        </div>
                        <?php
                            $query =            $connection->query("SELECT a.*, industries.Name as iName, divisions.Name as dName, account_manager.Name as aName
                                                                    FROM account a
                                                                    INNER JOIN industries ON (a.Industry = industries.ID)
                                                                    INNER JOIN divisions ON (divisions.ID = a.Division)
                                                                    INNER JOIN account_manager ON (account_manager.ID = a.ManagerID)");
                            while($row = $query->fetch_array()){
                              echo"
                                  <div class='contacto'>
                                      <div class='number'>".$row['ID']."</div>
                                      <div class='accName' style='cursor: pointer' onclick=\"LoadPage('Administrators/Account.php?id=".$row['ID']."');\" >".$row['Name']."</div>
                                      <div class='accIndustry'>".$row['iName']."</div>
                                      <div class='accAddress'>".$row['Address']."</div>
                                      <div class='accCompany'>".$row['Company']."</div>
                                      <div class='accManager'>".$row['aName']."</div>
                                  </div>";
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
