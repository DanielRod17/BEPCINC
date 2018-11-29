<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('connection.php');
session_start();

if(isset($_POST['searchConsultor'])){
    $output =             array();
    $stmt =               $connection->prepare("SELECT Name, ID
                                                FROM assignment
                                                WHERE ConsultorID = (SELECT ID
                                                                    FROM consultors
                                                                    WHERE Email = ?)");
    $stmt->               bind_param("s", $correo);
    $correo =             $_POST['searchConsultor'];
    $stmt ->              execute();
    $stmt ->              bind_result($Proj, $ID);
    while($stmt -> fetch()){
        $array =                    array("ID" => $ID, "Proj" => $Proj);
        array_push($output, $array);
    }
    echo json_encode($output);
}

if(isset($_POST['asignarExpense'])){
    $arreglo =          $_POST['asignarExpense'];
    $getConsultor =     $connection->prepare("SELECT ConsultorID FROM assignment WHERE ID=?");
    $getConsultor ->    bind_param("i", $ai);
    $ai =               $arreglo[4];
    $getConsultor ->    execute();
    $getConsultor ->    bind_result($CiD);
    $getConsultor ->    fetch();
    $getConsultor ->    close();
    $stmt =             $connection->prepare("INSERT INTO travels (ID, Name, AssignmentID, Status, FromDate, ToDate, ConsultorID) VALUES (NULL, ?, ?, 1, ?, ?, ?)");
    $stmt ->            bind_param("sissi", $N, $A, $SD, $ED, $C);
    $N =                $arreglo[1];
    $A =                $arreglo[4];
    $C =                $CiD;
    $Feca =             explode("/", $arreglo[2]);
    $SD =               $Feca[2]."-".$Feca[0]."-".$Feca[1];
    $Feca =             explode("/", $arreglo[3]);
    $ED =               $Feca[2]."-".$Feca[0]."-".$Feca[1];
    echo "Yes";
    $stmt ->            execute();
    //$stmt ->            store_result();
}

if(isset($_FILES) && isset($_POST['Travel'])){
    $travel =           $_POST['Travel'];
    $category =         $_POST['Category'];
    $name =             $_POST['Name'];
    $date =             explode("/", $_POST['datepicker']);
    $date =             $date[2]."-".$date[0]."-".$date[1];
    $qty =              $_POST['Qty'];
    $ref =              $_POST['Refundable'];
    if($ref == 'on'){
        $ref =            1;
    }else{
        $ref =            0;
    }
    $stmt =             $connection->prepare("SELECT ID FROM expenses WHERE TravelID=(SELECT ID FROM travels WHERE ConsultorID ='".$_SESSION['consultor']['ID']."') AND DATE(SubmitDate) = DATE(?)");
    $stmt ->            bind_param("s", $f);
    $f =                $date;
    $stmt ->            execute();
    $stmt ->            store_result();
    if($stmt -> num_rows > 0){
        echo "Expense Already Registered for this Date";
    }else{
        //////////////////////////
        $cadenita = "";
        $errors = array();
        $expensions =       array("jpeg","jpg","png", "pdf", "sql");
        foreach($_FILES as $file){
            $nombre =       $file['name'];
            $tmp =          $file['tmp_name'];
            $ext =          explode('.', $nombre);
            $ext =          strtolower(end($ext));
            if(in_array($ext, $expensions )=== false){
                $errors[] = "$nombre";
            }else{
                $dirname =      $_SESSION['consultor']['Email'];
                $cadenita =     $cadenita."$date/".$nombre."~";
                $nambre =       "$dirname/$date";
                if (!is_dir("../../Files/Expenses/$nambre")) {
                    mkdir("../../Files/Expenses/$nambre", 0775, true);
                    move_uploaded_file($tmp, "../../Files/Expenses/$nambre/".$nombre);
                }else{
                    move_uploaded_file($tmp, "../../Files/Expenses/$nambre/".$nombre);
                }
            }
        }
        if(empty($errors)){
            echo "Expense Added Successfully";
            $insertar =         $connection->prepare("INSERT INTO expenses (ID, TravelID, Category, Name, SubmitDate, Quantity, Refundable, Attachments, Status) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 1)");
            $insertar ->        bind_param("iissiis", $T, $C, $N, $SD, $Q, $R, $A);
            $T =                $travel;
            $C =                $category;
            $N =                $name;
            $SD =               $date;
            $Q =                $qty;
            $R =                $ref;
            $A =                $cadenita;
            $insertar ->        execute();
        }else{
            echo "Couldn't upload file(s):  ";
            for($i = 0; $i < count($errors); $i++){
                if($i + 1 == count($errors)){
                    echo $errors[$i];
                }else{
                    echo $errors[$i].", ";
                }
            }
            echo ".";
        }
        //////////////////////////
    }
}
