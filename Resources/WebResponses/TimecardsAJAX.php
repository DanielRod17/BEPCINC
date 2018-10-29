<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");

if(isset($_POST['checkNames'])){
    if(isset($_POST['names']) && sizeof($_POST['names']) > 0){
        $nombres =          $_POST['names'];
        $flag =             0;
        $idUsuario =        $_SESSION['consultor']['ID'];
        foreach($nombres as $nombre){
            $querty =           $connection->prepare("SELECT ID FROM assignment WHERE Name = ? AND (ID = (SELECT Assignment FROM consultors WHERE ID=?) OR PO = 0)");
            $querty ->          bind_param("si", $nome, $idi);
            $nome =             $nombre;
            $idi =              $idUsuario;
            $querty ->          execute();
            $querty ->          store_result();
            if($querty -> num_rows == 0){
                $flag =         1;
            }
            $querty ->          close();
        }
        if($flag == 0){
            echo "Alles gut";
        }else{
            echo "Check your projects' names";
        }
    }else{
        echo "Select at least one project";
    }
}

if(isset($_POST['insertar'])){
    $queryComa =             $connection->query("SELECT ID FROM timecards WHERE StartingDay='".$_SESSION['fecha']."' AND ConsultorID='".$_SESSION['consultor']['ID']."' ");
        if(isset($_SESSION['fecha']) && $_SESSION['fecha'] !== "" && $queryComa -> num_rows == 0){
            $lineas =            $_POST['lineas'];
            if($_POST['delete'] == '1'){
                $queryDel =         $connection->query("DELETE FROM lineas WHERE ConsultorID = '".$_SESSION['consultor']['ID']."' AND TimecardID='1'");
            }
            $matrix;
            $counterLinea = 1;
            $arreglo =      array();
            $bandera =      0;
            foreach($lineas as $linea){
                if($linea[0] != "" && ($linea[1] != "" || $linea[2] != "" || $linea[3] != "" || $linea[4] != "" || $linea[5] != "" || $linea[6] != "" || $linea[7] != "")){
                    $matrix[] =     $linea;
                }else{
                    array_push($arreglo, $counterLinea);
                    $bandera = 1;
                }
                $counterLinea++;
            }
            if($bandera == 0){
                foreach($matrix as $linea){
                    $queryID =          $connection->query("SELECT ID FROM lineas ORDER BY ID DESC Limit 1");
                    $queryID =          $queryID->fetch_object();
                    if($queryID !== null){
                        $ID =               $queryID->ID;
                        $ID =               $ID+1;
                    }else{
                        $ID =               1;
                    }
                    $query =            $connection->query("SELECT ID FROM assignment WHERE Name='".$linea[0]."'");
                    $queryR =           $query->fetch_object();
                    $AsI =              $queryR->ID;
                    $Co =               $_SESSION['consultor']['ID'];
                    $insertar =         $connection->prepare("INSERT INTO lineas (ID, AssignmentID, ConsultorID, TimecardID, Mon, Tue, Wed, Thu, Fri, Sat, Sun, StartingDay, CreatedDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insertar ->        bind_param('iiiiiiiiiiiss', $I, $A, $C, $T, $Mo, $Tu, $We, $Th, $Fr, $Sa, $Su, $SD, $CD);
                    $I =                $ID;
                    $A =                $AsI;
                    $C =                $Co;
                    $T =                1;
                    $Mo =               $linea[1];
                    $Tu =               $linea[2];
                    $We =               $linea[3];
                    $Th =               $linea[4];
                    $Fr =               $linea[5];
                    $Sa =               $linea[6];
                    $Su =               $linea[7];
                    $SD =               $_SESSION['fecha'];
                    $CD =               date("Y-m-d H:i:s",time()-60*60*4);
                    $insertar ->        execute();
                    $insertar ->        close();
                }
                echo "Timecard Saved! Leaving the page will delete it";
            }else{
                echo "Set at least an hour for line(s):   ";
               foreach($arreglo as $key => $a){
                   echo $arreglo[$key];
                   if(isset($arreglo[$key+1]))
                       echo ", ";
               }
            }
        }else{
            if($queryComa -> num_rows > 0)
            {
                echo "Week's timecard already registered";
            }
            else{
                echo "Select a Date";
            }
        }
}

if(isset($_POST['fecha'])){
    $_SESSION['fecha'] =        $_POST['fecha'];
}

if(isset($_POST['finishTimecard'])){
    $queryLines =       $connection->query("SELECT ID FROM lineas WHERE ConsultorID='".$_SESSION['consultor']['ID']."' AND TimecardID='1'");
    if($queryLines -> num_rows > 0){
        if(isset($_SESSION['fecha'])){
            $querty =           $connection->query("SELECT ID FROM timecards ORDER BY ID DESC LIMIT 1 ");
            if($querty -> num_rows == 0){
                $ID =       1;
            }else{
                $ID =           $querty->fetch_object();
                $ID =           $ID->ID;
                $ID =           $ID+1;
            }
            $queryInsert =      $connection->query("INSERT INTO timecards (ID, Name, ConsultorID, StartingDay, CreatedDate) VALUES ('$ID', 'Test$ID', '".$_SESSION['consultor']['ID']."','".$_SESSION['fecha']."', '".date("Y-m-d H:i:s",time()-60*60*4)."')");
            echo "Timecard Submitted!";
            $queryDel =         $connection->query("UPDATE lineas SET TimecardID='$ID' WHERE ConsultorID = '".$_SESSION['consultor']['ID']."' AND TimecardID='1'");

        }else{
            echo "Select a Date";
        }
    }else{
        echo "No Timecard Saved to Submit Available";
    }
}












