<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include('connection.php');

if(isset($_POST['checkNames'])){
    if(isset($_POST['names']) && sizeof($_POST['names']) > 0){
        $nombres =          $_POST['names'];
        $flag =             0;
        $idUsuario =        $_SESSION['consultor']['ID'];
        foreach($nombres as $nombre){
            //$querty =           $connection->prepare("SELECT ID FROM assignment WHERE Name = ? AND (ID = (SELECT Assignment FROM consultors WHERE ID=?) OR PO = 0)");
            $querty =           $connection->prepare("SELECT ID FROM assignment WHERE Name = ? AND (EXISTS(SELECT ProjectID FROM consultor2project WHERE ConsultorID=?) OR PO = 0)");
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

if(isset($_POST['usuarioBorrar'])){
    $_SESSION['usuarioBorrar'] =        $_POST['usuarioBorrar'];
}

if(isset($_POST['insertar'])){
    if(isset($_SESSION['fecha'])){
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
                    $CD =               date("Y-m-d H:i:s");
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
    }else{
         echo "Select a Date";
    }
}

if(isset($_POST['fecha'])){
    $output =                   array();
    $_SESSION['fecha'] =        $_POST['fecha'];
    $query =                    $connection->prepare("SELECT c.ID, Firstname, Lastname FROM consultors AS c
                                                        LEFT JOIN timecards AS t ON c.id = t.ConsultorID
                                                        WHERE DATE(t.StartingDay)=DATE(?) AND c.Type!='0'");
    $query ->                   bind_param("s", $feca);
    $feca =                     $_POST['fecha'];
    $query ->                   execute();
    $query ->                   bind_result($SN, $first, $last);
    while($query -> fetch()){
        //echo "$SN $first $last";
        $array =                    array("ID" => $SN, "First" => $first, "Last" => $last);
        array_push($output, $array);
    }
    echo json_encode($output);
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

            $querty =           $connection->query("SELECT Dailycount FROM timecards WHERE DATE(CreatedDate) = DATE(NOW()) ORDER BY ID DESC LIMIT 1 ");
            if($querty -> num_rows == 0){
                $Daily =            1;
            }else{
                $Daily =            $querty->fetch_object();
                $Daily =            $Daily->Dailycount;
                $Daily =            $Daily+1;
            }
            $Name =             "TCH-".date("Y-m-d",time()-60*60*4)."-$Daily";
            $queryInsert =      $connection->query("INSERT INTO timecards (ID, Name, ConsultorID, StartingDay, CreatedDate, Dailycount) VALUES ('$ID', '$Name', '".$_SESSION['consultor']['ID']."','".$_SESSION['fecha']."', '".date("Y-m-d H:i:s",time()-60*60*4)."', '$Daily')");
            echo "Timecard Submitted!";
            $queryDel =         $connection->query("UPDATE lineas SET TimecardID='$ID', StartingDay='".$_SESSION['fecha']."' WHERE ConsultorID = '".$_SESSION['consultor']['ID']."' AND TimecardID='1'");

        }else{
            echo "Select a Date";
        }
    }else{
        echo "No Timecard Saved to Submit Available";
    }
}

if(isset($_POST['nombreSearch'])){
    $arreglo =          array();
    $nombre =           $_POST['nombreSearch'];
    $fecha =            $_POST['fechaSearch'];
    $_SESSION['fechaSearch'] =  $fecha;
    $_SESSION['nombreSearch'] = $nombre;
    $query =                    $connection->prepare("SELECT lineas.*, assignment.Name
                                                    FROM lineas
                                                    LEFT JOIN assignment ON lineas.AssignmentID = assignment.ID
                                                    WHERE DATE(lineas.StartingDay)=DATE(?) AND lineas.ConsultorID = ?");
    $query ->                   bind_param("si", $feca, $idi);
    $feca =                     $_POST['fechaSearch'];
    $idi =                      $_POST['nombreSearch'];
    $query ->                   execute();
    $meta =                     $query->result_metadata();
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
        array_push($arreglo, $result);
    }
    echo json_encode($result);
}


if(isset($_POST['actualizar'])){
    //$_SESSION['fechaSearch'] =  $fecha;
    //$_SESSION['nombreSearch'] = $nombre;
    if(isset($_SESSION['fechaSearch'])){
        $queryComa =             $connection->query("SELECT ID FROM timecards WHERE StartingDay='".$_SESSION['fechaSearch']."' AND ConsultorID='".$_SESSION['nombreSearch']."' ");
        if(isset($_SESSION['fechaSearch']) && $_SESSION['fechaSearch'] !== "" && $queryComa -> num_rows != 0){
            $queryComaR =       $queryComa->fetch_object();
            $timecardID =       $queryComaR->ID;
            $lineas =           $_POST['lineas'];
            $queryDel =         $connection->query("DELETE FROM lineas WHERE ConsultorID = '".$_SESSION['nombreSearch']."' AND DATE(StartingDay)= DATE('".$_SESSION['fechaSearch']."')");
            $matrix;
            $counterLinea =     1;
            $arreglo =          array();
            $bandera =          0;
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
                    $Co =               $_SESSION['nombreSearch'];
                    $insertar =         $connection->prepare("INSERT INTO lineas (ID, AssignmentID, ConsultorID, TimecardID, Mon, Tue, Wed, Thu, Fri, Sat, Sun, StartingDay, CreatedDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insertar ->        bind_param('iiiiiiiiiiiss', $I, $A, $C, $T, $Mo, $Tu, $We, $Th, $Fr, $Sa, $Su, $SD, $CD);
                    $I =                $ID;
                    $A =                $AsI;
                    $C =                $Co;
                    $T =                $timecardID;
                    $Mo =               $linea[1];
                    $Tu =               $linea[2];
                    $We =               $linea[3];
                    $Th =               $linea[4];
                    $Fr =               $linea[5];
                    $Sa =               $linea[6];
                    $Su =               $linea[7];
                    $SD =               $_SESSION['fechaSearch'];
                    $CD =               date("Y-m-d H:i:s");
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
                echo "No week's timecard registered";
            }
            else{
                echo "Select a Date";
            }
        }
    }else{
         echo "Select a Date";
    }
}

if(isset($_POST['checkNaems'])){
    if(isset($_POST['names']) && sizeof($_POST['names']) > 0){
        $nombres =          $_POST['names'];
        $flag =             0;
        $idUsuario =        $_SESSION['nombreSearch'];
        foreach($nombres as $nombre){
            //$querty =           $connection->prepare("SELECT ID FROM assignment WHERE Name = ? AND (ID = (SELECT Assignment FROM consultors WHERE ID=?) OR PO = 0)");
            $querty =           $connection->prepare("SELECT ID FROM assignment WHERE Name = ? AND (EXISTS(SELECT ProjectID FROM consultor2project WHERE ConsultorID=?) OR PO = 0)");
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
