<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('connection.php');
session_start();

if (isset($_POST['informacion'])  && !isset($_POST['updateInfo'])){
    $arreglo =              $_POST['informacion'];
    ///////////////////
    if(strlen($arreglo[0]) >= 5){
        if($arreglo[1] === $arreglo[2]){
            if(strlen($arreglo[1]) >= 5 ){
                if(is_numeric($arreglo[9])){
                    //$querty =           $connection->query("SELECT ID FROM consultors WHERE SN = '".$arreglo[0]."'");
                    $querty =           $connection->prepare("SELECT ID FROM consultors WHERE SN = ?");
                    $querty ->          bind_param("s", $nome);
                    $nome =             $arreglo[0];
                    $querty ->          execute();
                    $querty ->          store_result();
                    if($querty -> num_rows == 0){
                        $queryID =          $connection->query("SELECT ID FROM consultors ORDER BY ID DESC Limit 1");
                        $queryID =          $queryID->fetch_object();
                        $ID =               $queryID->ID;
                        $ID =               $ID+1;
                        $insertar =         $connection->prepare("INSERT INTO consultors (ID, SN, Firstname, Lastname, Email, Roster, State, Type, Hash, Status, Phone, Sponsor, Assignment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $insertar ->        bind_param('issssssisisss', $I, $S, $F, $L, $E, $R, $St, $T, $H, $Sta, $P, $Sp, $As);
                        $I =                $ID;
                        $S =                $arreglo[0];
                        $F =                $arreglo[3];
                        $L =                $arreglo[4];
                        $E =                $arreglo[5]; //
                        $St =               $arreglo[7];
                        $R =                $arreglo[6];
                        $P =                $arreglo[10];
                        $Sp =               $arreglo[11];
                        $As =               $arreglo[12];
                        if($R == "MX"){
                            $St = "";
                        }
                        $T =                $arreglo[8];
                        $H =                sha1($arreglo[1]);
                        $Sta =              1;
                        $insertar ->        execute();
                        $insertar ->        close();
                        ///////////////////
                        $i =                0;
                        $dowMap = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
                        /////////
                        $schedule =             $arreglo[9];
                        $scheduleDays =         $connection->prepare("SELECT ID, Sun, Mon, Tue, Wed, Thu, Fri, Sat FROM schedules WHERE ID=?");
                        $scheduleDays->         bind_param("s", $schedule);
                        $scheduleDays ->        execute();
                        $scheduleDays ->        store_result();
                        if ($scheduleDays -> num_rows != 0){
                            $scheduleDays ->        bind_result($SchID, $Sun, $Mon, $Tue, $Wed, $Thu, $Fri, $Sat);
                            $scheduleDays ->        fetch();
                            $Actualizar =           $connection->prepare("UPDATE consultors SET Sun = ?, Mon = ?, Tue = ?, Wed = ?,
                                                    Thu =?, Fri = ?, Sat =?, Schedule = ? WHERE ID = ?");
                            $Actualizar ->          bind_param('iiiiiiiii', $S, $M, $T, $W, $J, $V, $Sa, $Sch, $Id);
                            $Id =                   $ID;
                            $S =                    $Sun;
                            $M =                    $Mon;
                            $T =                    $Tue;
                            $W =                    $Wed;
                            $J =                    $Thu;
                            $V =                    $Fri;
                            $Sa =                   $Sat;
                            $Sch =                  $SchID;
                            $Actualizar ->          execute();
                            $Actualizar ->          close();
                        }
                        echo "User Added Successfully";
                    }else{
                        echo "Username Already Exists";
                    }
                }else{
                    echo "Select a Schedule";
                }
            }else{
                echo "Passwords Must Be At Least 5 Characters Long";
            }
        }else{
            echo "Passwords Must Match";
        }
    }else{
        echo "Username Must Include At Least 5 characters";
    }
    //var_dump($_POST['informacion']);
}

if(isset($_POST['usuario'])){
    $usuario =              $_POST['usuario'];
    $stmt =                 $connection->prepare("SELECT ID, SN, Firstname, Lastname, Email, Roster, State, Type, Phone, Sponsor, Assignment, Status FROM consultors WHERE SN=?");
    $stmt ->                bind_param("s", $usuario);
    $stmt ->                execute();
    $stmt ->                store_result();
    if ($stmt -> num_rows != 0){
        $stmt ->                bind_result($ID, $SN, $FirstName, $LastName, $Email, $Roster, $State, $Type, $Phone, $Sponsor, $Assignment, $Status);
        $stmt ->                fetch();
        $_SESSION['EditID'] =  $ID;  
        $output = array("SN" => $SN, "FirstName" => $FirstName, "LastName" => $LastName, "Email" => $Email ,"Roster" => $Roster, 
            "State" => $State, "Type" => $Type, "Status" => $Status, "Phone" => $Phone, "Sponsor" => $Sponsor, 
            "Assignment" => $Assignment);
        echo json_encode($output);
    }else{
        unset($_SESSION['EditID']);
        $output = array("SN" => "No User Found");
        echo json_encode($output);
    }
}

if (isset($_POST['updateInfo'])){
    if(!isset($_SESSION['EditID']) || $_SESSION['EditID'] == null  || $_SESSION['EditID'] == ''){
        echo "Select a Valid Username";
    }else{
        //echo $_SESSION['EditID'];
        $arreglo =              $_POST['informacion'];
        /*echo "Username: ".$arreglo[0]."\n";
        echo "Pass: ".$arreglo[1]."\n";
        echo "CPass: ".$arreglo[2]."\n";
        echo "First: ".$arreglo[3]."\n";
        echo "Last: ".$arreglo[4]."\n";
        echo "Country: ".$arreglo[5]."\n";
        echo "State: ".$arreglo[6]."\n";
        echo "Type: ".$arreglo[7];*/
        ///////////////////
        if(strlen($arreglo[0]) >= 5){
            if($arreglo[1] === $arreglo[2]){
                if(strlen($arreglo[1]) >= 5 ){
                    if(is_numeric($arreglo[10])){
                        $insertar =         $connection->prepare("UPDATE consultors SET SN = ?, Firstname = ?, Lastname = ?, Email =?, Roster = ?, State = ?, Type = ?, Hash = ?, Status = ?, Phone = ?, Sponsor = ?, Assignment = ? WHERE ID = ?");
                        $insertar ->        bind_param('ssssssisisiii', $S, $F, $L, $E, $R, $St, $T, $H, $Sta, $P, $Sp, $As, $I);
                        $I =                $_SESSION['EditID'];
                        $S =                $arreglo[0];
                        $F =                $arreglo[3];
                        $L =                $arreglo[4];
                        $E =                $arreglo[5]; //
                        $St =               $arreglo[7];
                        $R =                $arreglo[6];
                        $P =                $arreglo[11];
                        $Sp =               $arreglo[12];
                        $As =               $arreglo[13];
                        if($R == "MX"){
                            $St = "";
                        }
                        $T =                $arreglo[8];
                        $H =                sha1($arreglo[1]);
                        $Sta =              $arreglo[9];
                        $insertar ->        execute();
                        $insertar ->        close();
                        ///////////////////
                        $schedule =             $arreglo[10];
                        $scheduleDays =         $connection->prepare("SELECT ID, Sun, Mon, Tue, Wed, Thu, Fri, Sat FROM schedules WHERE ID=?");
                        $scheduleDays->         bind_param("s", $schedule);
                        $scheduleDays ->        execute();
                        $scheduleDays ->        store_result();
                        if ($scheduleDays -> num_rows != 0){
                            $scheduleDays ->        bind_result($SchID, $Sun, $Mon, $Tue, $Wed, $Thu, $Fri, $Sat);
                            $scheduleDays ->        fetch();
                            $Actualizar =           $connection->prepare("UPDATE consultors SET Sun = ?, Mon = ?, Tue = ?, Wed = ?,
                                                    Thu =?, Fri = ?, Sat =?, Schedule = ? WHERE ID = ?");
                            $Actualizar ->          bind_param('iiiiiiiii', $S, $M, $T, $W, $J, $V, $Sa, $Sch, $Id);
                            $Id =                   $I;
                            $S =                    $Sun;
                            $M =                    $Mon;
                            $T =                    $Tue;
                            $W =                    $Wed;
                            $J =                    $Thu;
                            $V =                    $Fri;
                            $Sa =                   $Sat;
                            $Sch =                  $SchID;
                            $Actualizar ->          execute();
                            $Actualizar ->          close();
                        }
                        unset($_SESSION['EditID']);
                        echo "User Updated Successfully";
                    }else{
                        echo "Select a Schedule";
                    }
                }else{
                    echo "Passwords Must Be At Least 5 Characters Long";
                }
            }else{
                echo "Passwords Must Match";
            }
        }else{
            echo "Username Must Include At Least 5 characters";
        }
    }
}

