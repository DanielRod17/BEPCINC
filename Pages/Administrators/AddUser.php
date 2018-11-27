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

include('../../Resources/WebResponses/connection.php');
$IDUsuario =            $_SESSION['consultor']["ID"];
$UserName =             $_SESSION['consultor']["SN"];
if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true && $_SESSION['consultor']['Type'] == '0'){
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="../Resources/CSS/MasterCSS.css">
            <link rel="stylesheet" href="../Resources/CSS/AddUser/AddUser_Layout.css">
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <meta charset="UTF-8">
            <script src="../Resources/Javascript/AddUserJS.js"></script>
            <script>
                $( function() {
                    $( "#SDate, #EDate" ).datepicker({
                        altFormat: 'yyyy-mm-dd',  // Date Format used
                        firstDay: 0 // Start with Monday
                    });
                });
            </script>
            <title>
            </title>

        </head>
        <body>
            <div id="container">
                <div class="titulo">ADD NEW CONTACT</div>
                <div id ="alertas"></div>
                <div id="newCustomer">
                    <form id='AddContact' onsubmit='return RevisarInfo();'>
                        <div class='generalForm'>
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
                                    Phone
                                </div>
                                <div class="entrada">
                                    <input type='text' class='unico' id='Phone' required>
                                </div>
                            </div>
                            <div class="Linea">
                                <div class="plaecHolder">
                                    Emergency Phone
                                </div>
                                <div class="entrada">
                                    <input type='text' class='unico' id='EPhone' required>
                                </div>
                            </div>
                            <div class="Linea">
                                <div class="plaecHolder">
                                    Reports To
                                </div>
                                <div class="entrada">
                                    <select class='unico' id='ReportsTo'>
                                        <?php
                                            $query =            $connection->query("SELECT ID, Name FROM sponsor ORDER BY Name ASC");
                                            while($row = $query->fetch_array()){
                                                echo "<option value='".$row['ID']."'>".$row['Name']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="Linea">
                                <div class="plaecHolder">
                                    Start Date
                                </div>
                                <div class="entrada">
                                    <input type='text' class='unico' id='SDate' required>
                                </div>
                            </div>
                            <div class="Linea">
                                <div class="plaecHolder">
                                    End Date
                                </div>
                                <div class="entrada">
                                    <input type='text' class='unico' id='EDate'>
                                </div>
                            </div>
                            <div class="Linea">
                                <div class="plaecHolder">
                                    Title
                                </div>
                                <div class="entrada">
                                    <input type='text' class='unico' id='Title' required>
                                </div>
                            </div>
                            <div class="Linea">
                                <div class="plaecHolder">
                                    Division
                                </div>
                                <div class="entrada">
                                    <select class='unico' id='Division'>
                                        <option value='0'>BE OCS</option>
                                        <option value='1'>BE PRO</option>
                                        <option value='2'>BEPC MEXICO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="Linea">
                                <div class="plaecHolder">
                                    Functional Area
                                </div>
                                <div class="entrada">
                                    <select class='unico' id='FArea'>
                                        <?php
                                            $query =            $connection->query("SELECT ID, Name FROM areas ORDER BY Name ASC");
                                            while($row = $query->fetch_array()){
                                                echo "<option value='".$row['ID']."'>".$row['Name']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="Linea">
                                <div class="plaecHolder">
                                    Mailing Address
                                </div>
                                <div class="entrada">
                                    <input type='text' class='unico' id='MAddress' required>
                                </div>
                            </div>
                        </div>
                        <div class="Linea">
                            <div class="plaecHolder2">
                                Mailing Country
                            </div>
                            <div class="plaecHolder2">
                                Mailing State
                            </div>
                            <div class="entrada2">
                                <select class="unico" id='Country' onchange='EnableStates(this.value);'>
                                    <option value="142">MX</option>
                                    <option value="231">US</option>
                                </select>
                            </div>
                            <div class="entrada2">
                                 <select class="unico" id='State' onchange='ChangeCity(this.value);'>
                                    <?php
                                        $query =  $connection->query("SELECT name, id FROM states WHERE country_id=142");
                                        while($row = $query->fetch_array()){
                                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="Linea">
                            <div class="plaecHolder2">
                                Mailing City
                            </div>
                            <div class="plaecHolder2">
                                ZIP Code
                            </div>
                            <div class="entrada2">
                                <select class="unico" id='City'>
                                  <?php
                                      $query =  $connection->query("SELECT name, id FROM cities WHERE state_id='2427'");
                                      while($row = $query->fetch_array()){
                                          $name =     $row['name'];
                                          echo "<option value='".$row['id']."'>$name</option>";
                                      }
                                  ?>
                                </select>
                            </div>
                            <div class="entrada2">
                                 <input type='number' class='unico' id='Zip'>
                            </div>
                        </div>
                        <div class="Linea">
                            <div class="plaecHolder">
                                NSS
                            </div>
                            <div class="entrada">
                                <input type='text' class='unico' id='NSS' required>
                            </div>
                        </div>
                        <div class="Linea">
                            <div class="plaecHolder">
                                RFC
                            </div>
                            <div class="entrada">
                                <input type='text' class='unico' id='RFC' required>
                            </div>
                        </div>
                        <div class="Linea">
                            <div class="plaecHolder" style="margin-bottom: 20px;">
                                Type
                            </div>
                            <div class="entrada">
                                <select class='unico' style='width: 160px;' id='Type'>
                                    <option value='2'>Consultor</option>
                                    <option value='1'>Reclutador</option>
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
            </div>
        </body>
    </html>
    <?php
}else{
    header("Location: Dashboard.php");
}
