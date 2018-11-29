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
    $stmt =             $connection->prepare("INSERT INTO travels (ID, Name, AssignmentID, Status, FromDate, ToDate) VALUES (NULL, ?, ?, 1, ?, ?)");
    $stmt ->            bind_param("siss", $N, $A, $SD, $ED);
    $N =                $arreglo[1];
    $A =                $arreglo[4];

    $Feca =             explode("/", $arreglo[2]);
    $SD =               $Feca[2]."-".$Feca[0]."-".$Feca[1];
    $Feca =             explode("/", $arreglo[3]);
    $ED =               $Feca[2]."-".$Feca[0]."-".$Feca[1];

    echo "$SD $ED";
    $stmt ->            execute();
    $stmt ->            store_result();
}
