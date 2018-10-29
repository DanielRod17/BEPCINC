<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");
session_start();

if(isset($_POST['newAssignment'])){
    $arreglo =          $_POST['informacion'];
    $name =             $arreglo[0];
    $project =          $arreglo[1];
    $po =               $arreglo[2];
    $br =               $arreglo[3];
    $pr =               $arreglo[4];
    $em =               $arreglo[5];
    $querty =           $connection->prepare("SELECT ID FROM assignment WHERE Name = ?");
    $querty ->          bind_param("s", $name);
    $querty ->          execute();
    $querty ->          store_result();
    if($querty -> num_rows == 0){
        $queryPro =         $connection->prepare("SELECT ID FROM project WHERE Name = ?");
        $queryPro ->        bind_param("s", $project);
        $queryPro ->        execute();
        $queryPro ->        store_result();
        if($queryPro -> num_rows > 0){
            $queryPo =         $connection->prepare("SELECT ID FROM po WHERE NoPO = ?");
            $queryPo ->        bind_param("s", $po);
            $queryPo ->        execute();
            $queryPo ->        store_result();
            if($queryPo -> num_rows > 0){
                $queryUs =         $connection->prepare("SELECT ID FROM consultors WHERE SN = ?");
                $queryUs ->        bind_param("s", $em);
                $queryUs ->        execute();
                $queryUs ->        store_result();
                if($queryUs -> num_rows > 0){
                    $queryID =          $connection->query("SELECT ID FROM assignment ORDER BY ID DESC Limit 1");
                    $queryID =          $queryID->fetch_object();
                    if($queryID === null){
                        $ID =               1;
                    }else{
                        $ID =               $queryID->ID;
                        $ID =               $ID+1;
                    }
                    $queryPro ->        bind_result($Pro);
                    $queryPro ->        fetch();
                    $queryPo ->         bind_result($PuO);
                    $queryPo ->         fetch();
                    $insertar =         $connection->prepare("INSERT INTO assignment (ID, Name, BR, PR, ProjectID, PO) VALUES (?, ?, ?, ?, ?, ?)");
                    $insertar ->        bind_param('isddii', $I, $N, $B, $P,$PI, $PO);
                    $I =                $ID;
                    $N =                $name;
                    $B =                $br;
                    $P =                $pr;
                    $PI =               $Pro;
                    $PO =               $PuO;
                    $insertar ->        execute();
                    $insertar ->        close();
                    
                    $queryUp =          $connection->query("UPDATE consultors SET Assignment = '$ID' WHERE SN='$em'");
                    
                    echo "Assignment Added";
                }else{
                    echo "Select a Valid Username";
                }
            }else{
                echo "Select a Valid PO";
            }
        }else{
            echo "Select a Valid Project";
        }
    }else{
        echo "Assignment Already Registered";
    }
    $querty ->          close();
}
