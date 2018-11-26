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
    $stmt =               $connection->prepare("SELECT a.Name, a.ID
                                                FROM assignment a
                                                WHERE ProjectID IN (SELECT ProjectID
                                                                    FROM consultor2project
                                                                    WHERE ConsultorID=(SELECT ID FROM consultors WHERE Email=?)
                                                                  )
                                                ");
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
    $info =             $_POST['asignarExpense'];
    $stmt =             $connection->prepare("SELECT TravelID
                                            FROM assignment
                                            WHERE ID=? AND ProjectID IN(SELECT ProjectID FROM consultor2project WHERE ConsultorID=(SELECT ID FROM consultors WHERE Email=?))");
    $stmt ->            bind_param("is", $id, $consEmail);
    $id =               $info[3];
    $consEmail =        $info[0];
    $stmt ->            execute();
    $stmt ->            store_result();
    if($stmt -> num_rows > 0){
        echo "Yes";
    }else{
        echo "Select a Valid Assignment";
    }
}
