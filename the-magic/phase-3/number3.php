<?php
    $show = false;
if (empty($_GET['search'])){
    
}else {
    $mysqli = require __DIR__ . '/../database.php';
    $x = $_GET['search'];
    $sql = "SELECT i.*, r.rating
            FROM item i, reviews r
            WHERE i.username = '{$x}' AND r.rating IN ('excellent', 'good')
            HAVING COUNT(DISTINCT r.reviewID) = COUNT(*)";
    
    $result = $mysqli->query($sql);

    if($result){
        
        $users = $result->fetch_all(MYSQLI_ASSOC);
        $show = true;
    } else{
        die ($mysqli->error);
    }

    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>3</title>
</head>
<body>
    <script>
        function goBack() {
            location.href = 'phase3.php';
        }
    </script>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Phase3</i></button></div>
    <div class="search">
        <form method="get" action="number3.php">
            <input type="text" name="search" placeholder="User x">
            <button type="submit" value="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>
    <ul>
        <?php if($show) { foreach($users as $user): ?>
            <li><?= "Title: " . $user['title'] . " | Category: " . $user['category'] . " | Description: " . $user['description'] . " | Rating: " . $user['rating']?></li>
        <?php  endforeach; }?>
    </ul>
</body>
</html>