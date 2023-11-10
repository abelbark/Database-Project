<?php

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $mysqli = require "database.php";

        $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);

        if($result === false){
            die("Query error: " . $mysqli->error);
        }

        $user = $result->fetch_assoc();

        if($user and password_verify($_POST["password"], $user["password"])){
            session_start();
            $_SESSION['user-name'] = $user["username"];
            header('Location: arrival.php');
            exit();

        }else{
            die("Invalid Login");
        }      
        
    }
?>

