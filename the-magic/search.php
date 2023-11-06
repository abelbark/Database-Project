<?php
    $posted = false;
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    
    if(isset($_SESSION["first-name"])){

        $firstName = $_SESSION["first-name"];
        if(isset($_POST['search'])){
            $mysqli = require "database.php";
            $searchq = $_POST['search'];
            $query = "SELECT * FROM item WHERE Category LIKE '%{$searchq}%' OR Title LIKE '%{$searchq}%';";
            $result = $mysqli->query($query);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                echo '<div class="list-items"> <table><tr><th>Title</th><th>Category</th><th>Price</th><th>Description</th></tr>';
                while ($row = mysqli_fetch_assoc($result)){
                    echo '<tr>' . '<td>' . $row['Title'] . '</td>' . '<td>' . $row['Category'] . '</td>'. '<td>' . $row['Price'] . '</td>'. '<td>' . $row['Description'] . '</td>'.'</tr>';
                }
                echo '</table> </div>';
            }
            // $result = mysqli_query($mysqli,$query) or die($mysqli->error . " " . $mysqli->errno);
            // $result = mysqli_query()
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/gondrin" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="item.css">
    <title>Document</title>
    <script>
        function goBack(){
            location.href = 'arrival.php';
        }
    </script>
</head>
<body>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back' > Add Items</i></button></div>
    <div class="search">
        <form method="post" action="search.php">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" value="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>
</body>
</html>