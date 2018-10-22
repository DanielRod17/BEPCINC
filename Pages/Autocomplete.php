<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");
$sql =                  $connection->query("SELECT ID, SN FROM consultors");  
$output = array();

 while($row = $sql->fetch_array())
 {
    $data['id'] = $row['ID'];
    $data['value'] = $row['SN'];
    array_push($output, $data);
 }
 echo json_encode($output);

