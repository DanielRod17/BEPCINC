<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('connection.php');
session_start();

if(isset($_POST['newSponsor'])){
    $arreglo =          $_POST['informacion'];
    $name =             $arreglo[0];
    $email =            $arreglo[1];
    $company =          $arreglo[2];
    $querty =           $connection->prepare("SELECT ID FROM sponsor WHERE Name = ?");
    $querty ->          bind_param("s", $name);
    $querty ->          execute();
    $querty ->          store_result();
    if($querty -> num_rows == 0){
        $queryID =          $connection->query("SELECT ID FROM sponsor ORDER BY ID DESC Limit 1");
        $queryID =          $queryID->fetch_object();
        if($queryID === null){
            $ID =               1;
        }else{
            $ID =               $queryID->ID;
            $ID =               $ID+1;
        }
        $insertar =         $connection->prepare("INSERT INTO sponsor (ID, Name, Email, Company) VALUES (?, ?, ?, ?)");
        $insertar ->        bind_param('isss', $I, $N, $E, $C);
        $I =                $ID;
        $N =                $name;
        $E =                $email;
        $C =                $company;
        $insertar ->        execute();
        $insertar ->        close();
        echo "Sponsor Added";
    }else{
        echo "Sponsor Already Registered";
    }
    $querty ->          close();
}