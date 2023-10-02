<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $host = "my440cluster.cevb6hoe2jwx.us-east-2.rds.amazonaws.com";
    $dbname = "440Group";
    $username = "admin";
    $password = "somepassword";

    $mysqli = new mysqli($host, $username, $password, $dbname);
    $mysqli->autocommit(true);

    if($mysqli->connect_errno){
        die("Connection error: " . $mysqli->connect_error);
    }

    return $mysqli;

?>

