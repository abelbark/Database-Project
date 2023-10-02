<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(empty($_POST['user-name']) || empty($_POST['user-email']) ||
           empty($_POST['first-name']) || empty($_POST['last-name']) ||
           empty($_POST['user-password']) || empty($_POST["confirm-password"])){

               die("fill in the fields!!!");

        } elseif($_POST["user-password"] !== $_POST["confirm-password"]){

               die("passwords dont match");

        } elseif(strlen($_POST["user-password"]) < 6){

               die("password is invalid");

        } else {
            $new_password = password_hash($_POST["user-password"], PASSWORD_DEFAULT);

            $mysqli = require "database.php";

            $sql = "INSERT INTO user(username, password, firstName, lastName, email)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $mysqli->stmt_init();

            if(!$stmt->prepare($sql)){
                die("SQL error: " . $mysqli->error);
            }

            $stmt->bind_param("sssss", 
            $_POST["user-name"],
            $new_password,
            $_POST["first-name"],
            $_POST["last-name"],
            $_POST["user-email"]);

            if($stmt->execute()){
                
                echo "SignUp Successful";

            } else {

                die($mysqli->error . " " . $mysqli->errno);

            }

        }
    }


?>

