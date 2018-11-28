<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('connection.php');
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
            $queryMgr =         $connection->query("SELECT ManagerID FROM sponsor WHERE ID='$IDSp'");
            $queryMgrR =        $queryMgr->fetch_object();
            $mgrID =            $queryMgrR->ManagerID;
            $insertar =         $connection->prepare("INSERT INTO project (ID, Name, SponsorID, PLeader, Status, StartDate, EndDate, ManagerID) VALUES (?, ?, ?, ?, 1, ?, ?, ?)");
            $insertar ->        bind_param('isisssi', $I, $N, $S, $P, $SD, $ED, $M);
            $I =                $ID;
            $N =                $name;
            $S =                $IDSp;
            $P =                $leader;
            $Feca =             explode("/", $arreglo[3]);
            $SD =               $Feca[2]."-".$Feca[0]."-".$Feca[1];
            $Feca =             explode("/", $arreglo[4]);
            $ED =               $Feca[2]."-".$Feca[0]."-".$Feca[1];
            $M =                $mgrID;
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
