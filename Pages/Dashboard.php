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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../Resources/Javascript/Dashboard/DashboardJS.js"></script>
        <link rel="stylesheet" href="../Resources/CSS/Dashboard/Dashboard_Layout.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <meta charset="UTF-8">
        <title></title>
        </head>
        <body onscroll="DetectScroll();" onload=" DetectScroll();">
            <div id="contenedor">
                <div id="menu">
                    <div id="logo">
                        <div id="collapse" onclick="Collapse();">&nbsp;<i class="fas fa-angle-left fa-2x"></i></div>
                        <img id="logoIMG" src="../Resources/bepclogo.png"/>
                    </div>
                    <div id="informacion">
                        <div id="opciones">
                            <div class="opcion" onclick="LoadPage('Timecards.php')">Dashboard</div>
                            <div class="opcion">
                                Timecards
                                <div class="dropdown-content">
                                    <div class='links' onclick="LoadPage('Timecards.php');" >Timecards</div>
                                    <div class='links' onclick="<?php if($_SESSION['consultor']['Type'] == '0'){ echo "LoadPage('AdminCards.php');"; }else{  echo "LoadPage('AddTimecard.php');"; } ?>" >New Timecard</div>
                                </div>
                            </div>
                            <?php
                                if($_SESSION['consultor']['Type'] == '0'){
                                    ?>
                                    <div class='opcion'>
                                        Users
                                        <div class="dropdown-content">
                                            <div class='links' onclick="LoadPage('AddUser.php');" >Add User</div>
                                            <div class='links' onclick="LoadPage('EditUser.php');" >Update</div>
                                        </div>
                                    </div>
                                    <div class='opcion' onclick="LoadPage('CreateSchedule.php');" >
                                        Schedules
                                    </div>
                                    <div class='opcion' onclick="LoadPage('AddPO.php');" >POs</div>
                                    <div class='opcion' onclick="LoadPage('AddSponsor.php');" >Sponsors</div>
                                    <div class='opcion' onclick="LoadPage('AddProject.php');" >Projects</div>
                                    <div class='opcion' onclick="LoadPage('AddAssignment.php');" >
                                        Assignments
                                        <div class="dropdown-content">
                                            <div class='links'>Link 1</div>
                                            <div class='links'>Link 2</div>
                                            <div class='links'>Link 3</div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <div id="user">
                            <div id="profilepic">
                                <?php
                                    foreach (glob("./Resources/Images/UserPic/$IDUsuario.*") as $filename) {
                                        echo "<img style='width: 100%; height: 100%; border-radius: 50px;' src='$filename'>";
                                    }
                                ?>
                            </div>
                            <div id="infoUsuario">
                                <?php
                                    echo "<a href='#'>$UserName</a>";
                                ?>
                                <br>
                                <button id="logout" onclick="Logout();">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="goHome" onclick='goHome(this);'>&nbsp;<i class="fas fa-angle-left fa-2x"></i></div>
                <div id="contenido">
                    <iframe id="load" onload="iframeLoaded();" scrolling='no'>

                    </iframe>
                </div>
            </div>
            <div id="TopButton" onclick="ScrolltoTop();">
                &nbsp;<i class="fas fa-chevron-up"></i>
            </div>
            <div id="modal">
                <div id="modalContent">
                    <div id='top'>
                        <div id="close">
                            <i class="fas fa-plus rotate"></i>
                        </div>
                    </div>
                    <div id='content'></div>
                </div>
            </div>
        </body>
    </html>
<?php
}else{
    header("Location: ../index.php");
}
?>