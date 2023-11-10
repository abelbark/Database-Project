<?php
    $posted = false;
    $postsExceeded = false;
    $redirectBack = false;
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    if (isset($_SESSION["user-name"])) {

        $userName = $_SESSION["user-name"];

        $mysqli = require "database.php";

        // Get the current date in the correct format
        $date = date('Y-m-d');

        // Check the number of posts for the current user on the current date
        $sqlCheckLimit = "SELECT COUNT(*) AS post_count FROM item
        WHERE username = ? AND DATE_FORMAT(NOW(), '%Y-%m-%d') = ?"; // Use NOW() to get the current date

        $stmtCheckLimit = $mysqli->prepare($sqlCheckLimit);
        $stmtCheckLimit->bind_param("ss", $userName, $date);
        $stmtCheckLimit->execute();
        $resultCheckLimit = $stmtCheckLimit->get_result();
        $row = $resultCheckLimit->fetch_assoc();
        $postCountToday = $row["post_count"];

        $stmtCheckLimit->close();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (empty($_POST['item-name']) || empty($_POST['item-category']) ||
                empty($_POST['item-price']) || empty($_POST['item-description'])) {
                die("Fill in all the fields!");
            } else {

                if ($postCountToday >= 3) {
                    $postsExceeded = true;
                    $redirectBack = true;
                }
                else {
                    // Prepare the INSERT statement
                    $sql = "INSERT INTO item(Title, Category, Price, Description, username)
                        VALUES (?, ?, ?, ?, ?)";

                    $stmt = $mysqli->prepare($sql);

                    if (!$stmt) {
                        die("SQL error: " . $mysqli->error);
                    }

                    $price = floatval($_POST["item-price"]);

                    $stmt->bind_param("ssdss", 
                        $_POST["item-name"],
                        $_POST["item-category"],
                        $price,
                        $_POST["item-description"],
                        $userName
                    );

                    if ($stmt->execute()) {
                        $posted = true;
                    } else {
                        die($mysqli->error . " " . $mysqli->errno);
                    }
                }

            }
        }
    } else {
        header('Location: main.php');
        exit();
    }

    // Log out the user from the page
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: main.php");
        exit;
    }

    if($redirectBack){
        //header("arrival.php");
        echo "<script type= 'text/javascript'>
                alert('You Hit Your Daily Limit!');
                window.location.href = 'arrival.php';
              </script>";
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
        if($posted) {
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
            <!-- Item form-->
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
    
</body>
</html>

