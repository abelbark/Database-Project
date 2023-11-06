
<?php
    $posted = false;
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    
    if(isset($_SESSION["first-name"])){

        $firstName = $_SESSION["first-name"];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(isset($_POST['initialize'])){
                 $mysqli = require "database.php";
                 $query = "INSERT INTO item(Title, Description, Category, Price) VALUES ('Banana', 'Yellow afd', 'Food', '0.99'), ('USB-C cable', 'Connect usbc to usbc', 'Accessory', '9.99'), ('Antenna', 'nice antenna', 'Electronic', '19.99'), ('Apple', 'One of these a day keeps the doctor away', 'Food', '2.99'), ('Lipstick','Red', 'Cosmetic', '5.99'), ('Chips','Hot and spicy', 'Food', '3.99'), ('Headset','This gaming headset has rgb lights', 'Electronic', '54.99'), ('USB Hub','This lets you connect to multiple devices', 'Accessory', '29.99'), ('Wig','This is an all natural blue wig', 'Cosmetic', '99.99'), ('Pineapple','This is the most ripe and sweet pinapple ever', 'Food', '4.99'), ('Speakers','These speakers have strong bass', 'Electronic', '399.99')";
                 $mysqli->query($query);
            }else if(empty($_POST['item-name']) || empty($_POST['item-category']) ||
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
                   $posted = true;
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/gondrin" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="item.css">
    <title>Arrival</title>

    <script>

        var theItem;
        var itemPrice;

        function init(){

            theItem = document.getElementById("item-box");
            itemPrice = document.getElementById("item-price");

            itemPrice.value = "0.00";

            itemPrice.addEventListener("input", formatMoney);

        }

        function makeItemBoxVisisble(){
            theItem.style.display = "flex";
        }


        function formatMoney(){

            var input = itemPrice.value;
            input = input.replace(/[^\d.]/g, "");
            var parts = input.split(".");
            var decimalPart = parts[1];

            if(!decimalPart || decimalpart.length != 2){
                alert("Format must be 'x.xx'");
                itemPrice.value = "0.00";
                event.preventDefault();
            }

            
        }

        function hideArrivalContainer(){
            document.getElementById("container").style.display="none";
        }

        function showArrivalContainer(){
            document.getElementById("container").style.display="flex";
        }

        window.addEventListener("load", init);
    </script>


</head>
<body>
    <?php
    if( $posted ) {
        echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
        // $posted = false;
    }
    ?>
    <div class="search">
        <form method="post" action="search.php">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" value="submit" ><i class='bx bx-search'></i></button>
        </form>
    </div>
    <div class="arrival-container" id="container">
        

        <div class="header-container">
            <h3 id="create-header">Item</h3>
        </div>

        <div class="input-form">
            <!-- SignUp form-->
            <div id="item-box">
                <form action="arrival.php" method="post">
                    <div class="item-input">
                        <input type="text" 
                            id="item-name" 
                            placeholder="Item Name" 
                            name="item-name"><br>
                        <input type="text" 
                            id="item-category" 
                            placeholder="Item Category" 
                            name="item-category"><br>
                         <input type="text" 
                            id="item-price"
                            placeholder="0.00" 
                            name="item-price"><br>
                        <textarea
                            id="item-description"
                            placeholder="Item description"
                            name="item-description"></textarea><br>

                        <input type="submit" id="create" value="Create">
                        <p><a href="arrival.php?logout=1">Log Out</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="menu" id="menu">
        <div class="header-container">
            <h3 id="create-header">Initialize Database</h3>
        </div>
        <form action="arrival.php" method="post">
        <input type="submit" name="initialize" id="init" value="Initialize Database">
        </form>
    </div>
    
    
</body>
</html>

