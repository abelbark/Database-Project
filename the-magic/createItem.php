<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    if(isset($_SESSION["first-name"])){

        $firstName = $_SESSION["first-name"];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(empty($_POST['item-name']) || empty($_POST['item-category']) ||
               empty($_POST['item-price']) || empty($_POST['item-description'])){
    
                   die("fill in the fields!!!");
    
            } else {
    
                $mysqli = require "database.php";
    
                $sql = "INSERT INTO item(Title, Category, Price, Description)
                        VALUES (?, ?, ?, ?)";
    
                $stmt = $mysqli->stmt_init();
    
                if(!$stmt->prepare($sql)){
                    die("SQL error: " . $mysqli->error);
                }
    
                $price = floatval($_POST["item-price"]);
    
                $stmt->bind_param("ssds", 
                $_POST["item-name"],
                $_POST["item-category"],
                $price,
                $_POST["item-description"]);
    
                if($stmt->execute()){
                    
                    echo "Item Posted";
    
                } else {
    
                    die($mysqli->error . " " . $mysqli->errno);
    
                }
    
    
    
            }
        }

    } else {

        header('Location: main.php');
        exit();
    }

    //logs out the user from the page
    if(isset($_GET["logout"])){

        session_destroy();
        header("Location: main.php");
        exit;
    }

    

?>

