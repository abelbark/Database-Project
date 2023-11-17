<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $host = "database-design-proj.cvum0af99fvy.us-east-2.rds.amazonaws.com";
    $dbname = "Comp440Proj";
    $username = "admin";
    $password = "Mysql123";

    $mysqli = new mysqli($host, $username, $password, $dbname);
    $mysqli->autocommit(true);

    if($mysqli->connect_errno){
        die("Connection error: " . $mysqli->connect_error);
    }

    return $mysqli;

?>

