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
$Sponsor =              $_SESSION['consultor']["Sponsor"];
$resultado =            array();
include('../Resources/WebResponses/connection.php');
if (isset($_SESSION['consultor']['Login']) && $_SESSION['consultor']['Login'] == true){
    if(isset($_GET['id'])){
    $ID =                   $_GET['id']; //Reemplazar por el get
    //$ID =                   2;
    $query =                $connection->prepare("SELECT * FROM consultors WHERE ID=?");
    $query ->               bind_param('i', $I);
    $I =                    $ID;
    $query ->               execute();
    $meta =                 $query->result_metadata(); 
    while ($field = $meta->fetch_field()) 
    { 
        $params[] = &$row[$field->name]; 
    }
    call_user_func_array(array($query, 'bind_result'), $params);
    while ($query->fetch()) { 
        foreach($row as $key => $val) 
        { 
            $c[$key] = $val; 
        }
        $result[] = $c;
    }
    $query ->               close();
    
    ////////////////////////////////
    ////////////////////////////////
    
    $stmt =                 $connection->prepare("SELECT * FROM timecards WHERE ConsultorID=?");
    $stmt ->                bind_param('i', $I);
    $I =                    $ID;
    $stmt ->                execute();
    $meta =                 $stmt->result_metadata(); 
    while ($field = $meta->fetch_field()) 
    { 
        $paramas[] = &$rowa[$field->name]; 
    }
    call_user_func_array(array($stmt, 'bind_result'), $paramas);
    while ($stmt->fetch()) { 
        foreach($rowa as $keya => $vala) 
        { 
            $d[$keya] = $vala; 
        }
        $resultado[] = $d;
    }
    $stmt ->                close();
?>
        <html>
            <head>
                <link rel="stylesheet" href="../Resources/CSS/Contacts/ContactInfo_Layout.css">
                <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
                <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">           
                <script src="../Resources/Javascript/Contacts/ContactsJS.js"></script><meta charset="UTF-8">
                <title>
                </title>
            </head>
            <body>
                <div id="contenedor">
                    <div id="resumen">
                        <div id="arriba">
                            <div id="badge">
                                &nbsp;<i class="fas fa-address-card"></i>
                            </div>
                            <div id="presentacion">
                                Contact
                                <br>
                                <?php
                                    echo $c['Firstname']." ".$c['Lastname'];
                                ?>
                            </div>
                        </div>
                        <div id="abajo">
                            <div id="titulos">
                                <div class="dato">
                                    Title
                                </div>
                                <div class="dato">
                                    Account Name
                                </div>
                                <div class="dato" style="width: 12% !important;">
                                    Phone
                                </div>
                                <div class="dato">
                                    Email
                                </div>
                                <div class="dato">
                                    Contact Owner
                                </div>
                            </div>
                            <div id="datos">
                                <div class="dato">
                                    D
                                </div>
                                <div class="dato">
                                    Account Name
                                </div>
                                <div class="dato" style="width: 12% !important;">
                                    <?php echo $c['Phone']; ?>
                                </div>
                                <div class="dato">
                                    <?php echo $c['Email']; ?>
                                </div>
                                <div class="dato">
                                    Contact Owner
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contenido">
                        <div id="contenidoCTN">
                            <div id="opcaos">
                                <div class="opcContenido">
                                    Related
                                </div>
                                <div class="opcContenido">
                                    Details
                                </div>
                            </div>
                            <div id="advertenquia">
                                
                            </div>
                            <div id="timecards">
                                <div id="timecardsAm">
                                    Timecards +6
                                </div>
                                <div id="timecardsLine" style="background-color: rgb(250, 250, 248)">
                                    <div class="TCRDcolumna">
                                        TIMECARD ID
                                    </div>
                                    <div class="TCRDcolumna">
                                        PROJECT
                                    </div>
                                    <div class="TCRDcolumna">
                                        START DATE
                                    </div>
                                    <div class="TCRDcolumna">
                                        END DATE
                                    </div>
                                    <div class="more">
                                    </div>
                                </div>
                                <?php
                                    if(count($resultado) > 0 && is_array($resultado)){
                                        foreach($resultado as $fila){
                                            ?>
                                                <div id="timecardsLine">
                                                    <div class="TCRDcolumna">
                                                        <?php echo $fila['Name']; ?>
                                                    </div>
                                                    <div class="TCRDcolumna">
                                                        <?php echo $fila['ConsultorID']; ?>
                                                    </div>
                                                    <div class="TCRDcolumna">
                                                        <?php echo substr($fila['StartingDay'], 0, 10); ?>
                                                    </div>
                                                    <div class="TCRDcolumna">
                                                        <?php echo substr($fila['CreatedDate'], 0, 10); ?>
                                                    </div>
                                                    <div class="more">
                                                        &nbsp;<i class="far fa-caret-square-down"></i>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <div id="timecardsLine">
                                                <div class="TCRDcolumna">
                                                    No timecards found
                                                </div>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </html>
        <?php
    }else{
        echo "Forbidden Access";
    }
}else{
    header("Location: ../index.php");
}
?>
