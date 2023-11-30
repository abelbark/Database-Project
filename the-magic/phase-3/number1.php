<?php
    $mysqli = require __DIR__ . '/../database.php';

    $sql = "WITH RankedItems AS (
                SELECT *, ROW_NUMBER() OVER (PARTITION BY category ORDER BY price DESC) AS ranking
                FROM item 
                )
                SELECT *
                FROM RankedItems
                WHERE ranking = 1;";
    
    $result = $mysqli->query($sql);

    if($result){
        $users = $result->fetch_all(MYSQLI_ASSOC);
    } else{
        die ($mysqli->error);
    }

    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>1</title>
</head>
<body>
    <script>
        function goBack() {
            location.href = 'phase3.php';
        }
    </script>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Phase3</i></button></div>
    <ul>
        <?php  foreach($users as $user): ?>
            <li><?= "Category: " . $user['category'] . " | " . "Title: " . $user['title'] . " | Price: " . $user['price'] ?></li>
        <?php  endforeach; ?>
    </ul>
</body>
</html>