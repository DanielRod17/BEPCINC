<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('connection.php');
session_start();
if(isset($_POST['usuario'])){
    $usuario =              $_POST['usuario'];
    $password =             sha1($_POST['contra']);
    $sID =                  session_id();
    //echo $usuario." ".$password;
    $stmt =                 $connection->prepare("SELECT ID, SN, Email, Firstname, Lastname, Division, StartDate, EndDate, Type, Status, LastLogin, Logged, SessionID FROM consultors WHERE SN=? AND Hash=?");
    $stmt ->                bind_param("ss", $usuario, $password);
    $stmt ->                execute();
    $stmt ->                store_result();
    if ($stmt -> num_rows != 0){
        $stmt ->                bind_result($ID, $SN, $Email, $FirstName, $LastName, $Division, $StartDate, $EndDate, $Type, $Status, $Login, $Logged, $SessionID);
        $stmt ->                fetch();
        $query =                $connection->query("UPDATE consultors SET LastLogin=NOW(), Logged='1', SessionID='$sID' WHERE ID='$ID'");
        $_SESSION['consultor'] = array("ID" => $ID, "SN" => $SN,"FirstName" => $FirstName, "LastName" => $LastName, "Email" => $Email, "Division" => $Division,
            "StartDate" => $StartDate, "EndDate" => $EndDate, "Type" => $Type, "Status" => $Status, "Login" => $Login, "Logged" => $Logged,
            "SessionID" => $SessionID);
        echo "success";
    }
    else{
        echo    "Wrong Credentials";
    }
    $stmt->                 close();
}
