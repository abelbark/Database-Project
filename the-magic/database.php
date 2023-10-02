<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $host = "localhost";
    $dbname = "440Group";
    $username = "root";
    $password = "mysql";

    $mysqli = new mysqli($host, $username, $password, $dbname);
    $mysqli->autocommit(true);

    if($mysqli->connect_errno){
        die("Connection error: " . $mysqli->connect_error);
    }

    return $mysqli;

?>

