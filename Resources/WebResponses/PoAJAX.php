<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('connection.php');
session_start();

if(isset($_POST['newPO'])){
    $arreglo =          $_POST['informacion'];
    $number =           $arreglo[0];
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
        $insertar =         $connection->prepare("INSERT INTO po (ID, NoPO, Ammount, Currency, Status) VALUES (?, ?, ?, ?, ?)");
        $insertar ->        bind_param('issii', $I, $N, $A, $C, $S);
        $I =                $ID;
        $N =                $arreglo[0];
        $A =                $arreglo[1];
        $C =                $arreglo[2];
        $S =                $arreglo[3];
        $insertar ->        execute();
        $insertar ->        close();
        echo "PO Added";
    }else{
        echo "PO Number Already Registered";
    }
    $querty ->          close();
}
