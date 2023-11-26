<?php
$posted = false;
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$resultCheck = 0; // Initialize $resultCheck outside the condition

if (isset($_SESSION["user-name"])) {
    $firstName = $_SESSION["user-name"];
    if (isset($_GET['search'])) {
        $mysqli = require "database.php";
        $searchq = isset($_GET['search']) ? $_GET['search'] : '';

        // Count the total number of items
        $countQuery = "SELECT COUNT(*) AS total FROM item WHERE category LIKE '%{$searchq}%' OR title LIKE '%{$searchq}%';";
        $countResult = $mysqli->query($countQuery);
        $totalCount = $countResult->fetch_assoc()['total'];

        // Set the number of items to display per page
        $itemsPerPage = 8;

        // Calculate the total number of pages
        $totalPages = ceil($totalCount / $itemsPerPage);

        // Get the current page number from the URL, default to 1
        $currentPage = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

        // Calculate the offset for the SQL query based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Modify your SQL query to include the LIMIT clause
        $query = "SELECT * FROM item WHERE category LIKE '%{$searchq}%' OR title LIKE '%{$searchq}%' LIMIT $offset, $itemsPerPage;";

        $result = $mysqli->query($query);

        if (!$result) {
            die('Error: ' . $mysqli->error);
        }

        $resultCheck = mysqli_num_rows($result);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/gondrin" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="item.css">
    <title>Search Results</title>
    <script>
        function goBack() {
            location.href = 'arrival.php';
        }
    </script>
</head>
<body>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Arrival</i></button></div>
    <div class="search">
        <form method="get" action="search.php">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" value="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>

    <?php
    if ($resultCheck > 0) {
        echo '<div class="result-container">';
        echo '<div class="list-items"> <table><tr><th>Title</th><th>Category</th><th>Price</th><th>Description</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td><a href="Reviewfunction.php?itemID=' . $row['itemID'] . '">';
            echo (isset($row['title']) ? $row['title'] : '');
            echo '</a></td>';
            echo '<td>' . (isset($row['category']) ? $row['category'] : '') . '</td>';
            echo '<td>' . (isset($row['price']) ? $row['price'] : '') . '</td>';
            echo '<td>' . (isset($row['description']) ? $row['description'] : '') . '</td>';
            echo '</tr>';
        }
        echo '</table> </div>';

        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            // Display current page differently
            if ($i == $currentPage) {
                echo "<span> $i</span>";
            } else {
                echo "<a href='search.php?page=$i&search=" . urlencode($searchq) . "'> $i </a>";
            }
        }
        echo '</div>';
        echo '</div>';
        } else {
            echo '<p>No results found.</p>';
        }
    ?>
</body>
</html>



