<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_POST['usuario'])){
    $connection=            mysqli_connect("localhost", "root", "peloncio1234.", "bepcinc");
    $usuario =              $_POST['usuario'];
    $password =             sha1($_POST['contra']);
    $sID =                  session_id();
    //echo $usuario." ".$password;
    $stmt =                 $connection->prepare("SELECT * FROM consultors WHERE SN=? AND Hash=?");
    $stmt ->                bind_param("ss", $usuario, $password);
    $stmt ->                execute();
    $stmt ->                store_result();
    if ($stmt -> num_rows != 0){
        $stmt ->                bind_result($ID, $SN, $FirstName, $LastName, $Email, $Phone, $Roster, $Sponsor, $Assignment, $State, $Type, $Schedule, $MexID, $PayrollID, $Sun, $Mon, $Tue, $Wed, $Thu, $Fri, $Sat, $Hash, $Status, $Login, $Logged, $SessionID, $Hours);
        $stmt ->                fetch();
        $query =                $connection->query("UPDATE consultors SET LastLogin=NOW(), Logged='1', SessionID='$sID' WHERE ID='$ID'");
        $_SESSION['consultor'] = array("ID" => $ID, "SN" => $SN, "FirstName" => $FirstName, "Email" => $Email, "Phone" => $Phone, "Roster" => $Roster, "Sponsor" => $Sponsor, "Assignment" => $Assignment,
            "State" => $State, "Type" => $Type, "Schedule" => $Schedule, "Sun" => $Sun, "Mon" => $Mon, "Tue" => $Tue, "Wed" => $Wed, "Thu" => $Thu,
            "Fri" => $Fri, "Sat" => $Sat ,"Status" => $Status, "Login" => $Login, "Logged" => $Logged, 
            "SessionID" => $SessionID, "Hours" => $Hours, "MexID" => $MexID, "PayrollID" => $PayrollID);
        echo "success";
    }
    else{
        echo    "Wrong Credentials";
    }
    $stmt->                 close();          
}

