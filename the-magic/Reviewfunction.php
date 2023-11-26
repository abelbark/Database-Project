<?php
$posted = false;
$redirectBack = false;
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_SESSION["user-name"])) {
    $userName = $_SESSION["user-name"];
    $mysqli = require "database.php";

    if (isset($_GET['itemID'])) {
        $itemID = $_GET['itemID'];

        $query = "SELECT * FROM item WHERE itemID = ?";
        $stmtItem = $mysqli->prepare($query);
        $stmtItem->bind_param("i", $itemID);
        $stmtItem->execute();
        $result = $stmtItem->get_result();

        if (!$result) {
            die('Error: ' . $mysqli->error);
        }

        $stmtItem->close();
    } else {
        die("Item ID is not set.");
    }

    // Get the current date in the correct format
    $date = date('Y-m-d');

    // Check the number of posts for the current user on the current date
    $sqlCheckLimit = "SELECT COUNT(*) AS post_count FROM reviews
        WHERE username = ? AND DATE_FORMAT(NOW(), '%Y-%m-%d') = ?"; // Use NOW() to get the current date

    $stmtCheckLimit = $mysqli->prepare($sqlCheckLimit);
    $stmtCheckLimit->bind_param("ss", $userName, $date);
    $stmtCheckLimit->execute();
    $resultCheckLimit = $stmtCheckLimit->get_result();
    $row = $resultCheckLimit->fetch_assoc();
    $reviewPostCountToday = $row["post_count"];

    $stmtCheckLimit->close();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (empty($_POST['rating']) || empty($_POST['review-text'])) {
            die("Fill in all the fields!");
        } else {
            if ($reviewPostCountToday >= 3) {
                $redirectBack = true;
            } else {
                // Prepare the INSERT statement
                $sql = "INSERT INTO reviews(itemID, username, rating, reviewText)
                    VALUES (?, ?, ?, ?)";

                $stmt = $mysqli->prepare($sql);

                if (!$stmt) {
                    die("SQL error: " . $mysqli->error);
                }

                $stmt->bind_param("ssss",
                    $itemID,
                    $userName,
                    $_POST["rating"],
                    $_POST["review-text"]
                );

                if ($stmt->execute()) {
                    $posted = true;
                } else {
                    die($stmt->error . " " . $stmt->errno);
                }
            }
        }
    }

    if ($redirectBack) {
        echo "<script type='text/javascript'>
            alert('You Hit Your Review Limit!');
            window.location.href = 'search.php?itemID=$itemID';
          </script>";
        exit;
    }
} else {
    header('Location: main.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="review.css">
    <title>Review</title>
    <script>
        function goBack() {
            location.href = 'search.php';
        }
    </script>
</head>
<body>
    <?php
    if ($posted) {
        echo "<script type='text/javascript'>alert('Thanks for the Review')</script>";
    }
    ?>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Items</i></button></div>
    <?php
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="item-box">';
        echo '<h2>' . (isset($row['title']) ? $row['title'] : '') . '</h2>';
        echo '<p>Category: ' . (isset($row['category']) ? $row['category'] : '') . '</p>';
        echo '<p>Price: $' . (isset($row['price']) ? $row['price'] : '') . '</p>';
        echo '<p>Description: ' . (isset($row['description']) ? $row['description'] : '') . '</p>';
        echo '</div>';
    }
    ?>
    <div class="review-div">
    <form action="Reviewfunction.php?itemID=<?php echo isset($itemID) ? $itemID : ''; ?>" method="post">
            <h2>Review</h2>
            <input type="radio" id="excellent" name="rating" value="excellent">
            <label for="excellent">Excellent</label><br>
            <input type="radio" id="good" name="rating" value="good">
            <label for="good">Good</label><br>
            <input type="radio" id="fair" name="rating" value="fair">
            <label for="fair">Fair</label><br>
            <input type="radio" id="poor" name="rating" value="poor">
            <label for="poor">Poor</label><br>
            <textarea id="review-text" placeholder="Write A Review" name="review-text"></textarea><br>
            <input type="submit" id="create" value="Post">
        </form>
    </div>
</body>
</html>
