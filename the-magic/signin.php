<?php

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $mysqli = require "database.php";

        $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

        if($user and password_verify($_POST["password"], $user["password"])){
            $first = $user["firstName"];
            die("Hello $first"); 
        }else{
            die("Invalid Login");
        }

        
        
    }
?>