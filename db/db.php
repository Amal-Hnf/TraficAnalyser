<?php 
    $server = "sql104.infinityfree.com"; #localhost
    $username = "if0_39893908";
    $password = "7lCNnqR9dJBR";
    $dbname = "if0_39893908_trafficdata";

    $conn = mysqli_connect($server, $username, $password, $dbnamedbn);
    if(!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }
?>