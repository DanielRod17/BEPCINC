<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");
session_start();

if(isset($_POST['newProject'])){
    $arreglo =          $_POST['informacion'];
    $name =             $arreglo[0];
    $sponsor =          $arreglo[1];
    $leader =           $arreglo[2];
    $querty =           $connection->prepare("SELECT ID FROM project WHERE Name = ?");
    $querty ->          bind_param("s", $name);
    $querty ->          execute();
    $querty ->          store_result();
    if($querty -> num_rows == 0){
        $quertySponsor =    $connection->prepare("SELECT ID FROM sponsor WHERE Name = ?");
        $quertySponsor ->   bind_param("s", $sponsor);
        $quertySponsor ->   execute();
        $quertySponsor ->   store_result();
        if($quertySponsor -> num_rows > 0){
            $quertySponsor ->       bind_result($IDSp);
            $quertySponsor ->       fetch();
            $queryID =          $connection->query("SELECT ID FROM project ORDER BY ID DESC Limit 1");
            $queryID =          $queryID->fetch_object();
            if($queryID === null){
                $ID =               1;
            }else{
                $ID =               $queryID->ID;
                $ID =               $ID+1;
            }
            $insertar =         $connection->prepare("INSERT INTO project (ID, Name, SponsorID, PLeader) VALUES (?, ?, ?, ?)");
            $insertar ->        bind_param('isss', $I, $N, $S, $P);
            $I =                $ID;
            $N =                $name;
            $S =                $IDSp;
            $P =                $leader;
            $insertar ->        execute();
            $insertar ->        close();
            echo "Project Added";
        }else{
            echo "Invalid Sponsor's Name";
        }
    }else{
        echo "Project Already Registered";
    }
    $querty ->          close();
}