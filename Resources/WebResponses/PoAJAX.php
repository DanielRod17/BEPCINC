<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");
session_start();

if(isset($_POST['newPO'])){
    $arreglo =          $_POST['informacion'];
    $number =           $arreglo[0];
    $ammount =          $arreglo[1];
    $querty =           $connection->prepare("SELECT ID FROM po WHERE NoPO = ?");
    $querty ->          bind_param("s", $number);
    $querty ->          execute();
    $querty ->          store_result();
    if($querty -> num_rows == 0){
        $queryID =          $connection->query("SELECT ID FROM po ORDER BY ID DESC Limit 1");
        $queryID =          $queryID->fetch_object();
        if($queryID === null){
            $ID =               1;
        }else{
            $ID =               $queryID->ID;
            $ID =               $ID+1;
        }
        $insertar =         $connection->prepare("INSERT INTO po (ID, NoPO, Ammount) VALUES (?, ?, ?)");
        $insertar ->        bind_param('iss', $I, $N, $A);
        $I =                $ID;
        $N =                $number;
        $A =                $ammount;
        $insertar ->        execute();
        $insertar ->        close();
        echo "PO Added";
    }else{
        echo "PO Number Already Registered";
    }
    $querty ->          close();
}