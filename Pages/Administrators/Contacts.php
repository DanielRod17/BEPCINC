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
//if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true){
?>
    <html>
        <head>
            <link rel="stylesheet" href="../Resources/CSS/Listas_Contenido/Listas_Layout.css">
            <link rel="stylesheet" href="../Resources/CSS/Listas_Contenido/ListasPrincipales_Layout.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <script src="../Resources/Javascript/ContactsJS.js"></script><meta charset="UTF-8">
            <title>
            </title>
        </head>
        <body>
            <div id="contenedor">
                <div class='titulo'>
                    CONTACTS
                </div>
                <div id="buscador">
                    <div id="searchParams">
                        <div>
                            <div id="image">
                                IMG
                            </div>
                            <div id="banner">
                                Contacts
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
                        <button id="botonNew" onclick="LoadPage('Administrators/AddUser.php');"><i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
                <div class="infoTable">
                    <div class="contacto">
                        <div class="number">&nbsp;</div>
                        <div class="NameContact">NAME</div>
                        <div class="Phone">PHONE</div>
                        <div class="Email">EMAIL</div>
                        <div class="ContactOw">CONTACT OWNER</div>
                    </div>
                    <?php
                        $query =            $connection->query("SELECT * FROM consultors WHERE Status='1' AND Type!='0'");
                        while($row = $query->fetch_array()){
                            echo"
                                <div class='contacto'>
                                    <div class='number'>".$row['ID']."</div>
                                    <div class='NameContact ctdName' id='".$row['ID']."'>".$row['Firstname']." ".$row['Lastname']."</div>
                                    <div class='Phone'>".$row['Phone']."</div>
                                    <div class='Email'>".$row['Email']."</div>
                                    <div class='ContactOw'>l</div>
                                </div>
                            ";
                            //echo "<div class='contactoInfo'></div>";
                        }
                    ?>
                </div>
            </div>
        </body>
    </html>
    <?php
/*}else{
    header("Location: ../../index.php");
}*/
?>
