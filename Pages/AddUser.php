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

$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");
$IDUsuario =            $_SESSION['consultor']["ID"];
$UserName =             $_SESSION['consultor']["SN"];
if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true && $_SESSION['consultor']['Type'] == '0'){
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="../Resources/CSS/MasterCSS.css">
            <link rel="stylesheet" href="../Resources/CSS/AddUser/AddUser_Layout.css">
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <meta charset="UTF-8">
            <title>

            </title>
        </head>
        <body>
            <div id="container">
                <div class="titulo">Add User</div>
                <div id ="alertas"></div>
                <form id="newCustomer" class="masterForm" onsubmit='return RevisarInfo();'>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Username
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='SN' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Password
                        </div>
                        <div class="entrada">
                            <input type='password' class='unico' id='Password' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Confirm Password
                        </div>
                        <div class="entrada">
                            <input type='password' class='unico' id='CPassword' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            First Name
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='First' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Last Name
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Last' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Email
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Email' required>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder">
                            Phone
                        </div>
                        <div class="entrada">
                            <input type='text' class='unico' id='Phone' required>
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
                    <div class="Linea">
                        <div class="plaecHolder2">
                            Sponsor
                        </div>
                        <div class="plaecHolder2">
                            Assignment
                        </div>
                        <div class="entrada2">
                            <select class="unico" id='Sponsor'>
                                <option value="1">Sponsor</option>
                            </select>
                        </div>
                        <div class="entrada2">
                             <select class="unico" id='Assignment'>
                                 <option value="1">Assignment</option>
                                <?php
                                    /*$query =  $connection->query("SELECT name FROM states");
                                    while($row = $query->fetch_array()){
                                        $name =     $row['name'];
                                        echo "<option value='$name'>$name</option>";
                                    }*/
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="Linea">
                        <div class="plaecHolder" style="margin-bottom: 20px;">
                            Type
                        </div>
                        <div class="entrada">
                            <select class='unico' style='width: 160px;' id='Type'>
                                <option value='1'>Consultor</option>
                                <option value='0'>Administrator</option>
                            </select>
                        </div>
                    </div>
                    <div class="Linea" style="margin-top: 30px;">
                        <div class="plaecHolder" style="margin-bottom: 20px;">
                            Schedule
                        </div>
                        <div class="entrada">
                            <select class='unico' style='width: 160px;' id='Schedule'>
                                <?php
                                    $query =  $connection->query("SELECT ID, Name FROM schedules ORDER BY Name ASC");
                                    while($row = $query->fetch_array()){
                                        $name =     $row['Name'];
                                        $name =     str_replace("_", " ", $name);
                                        $id =       $row['ID'];
                                        echo "<option value='$id'>$name</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="Linea" style="margin-bottom: 30px;">
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
