<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$Name =                 $_GET['term'];
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");

$user =                 $_SESSION['consultor']["ID"];
$sql =                  $connection->query("SELECT Name FROM assignment WHERE Name LIKE '%$Name%' AND ID=(SELECT Assignment FROM consultors WHERE ID='$user') OR PO='0'");  
$output = array();

 while($row = $sql->fetch_array())
 {
    $output[] = $row['Name'];
 }
 echo json_encode($output);