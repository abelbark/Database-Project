<?php
    $show = false;
if (empty($_GET['search'])){
    
}else {
    $mysqli = require __DIR__ . '/../database.php';
    $date = $_GET['search'];
    $sql = "Select *, (Select COUNT(*)
            from item i
            where i.username = u.username and DATE(i.postDate) = '{$date}') as postedItems
            from user u
            having postedItems > 0
            order by postedItems DESC
            limit 1;";
    
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
    <title>4</title>
</head>
<body>
    <script>
        function goBack() {
            location.href = 'phase3.php';
        }
    </script>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Phase3</i></button></div>
    <div class="search">
        <h3 style="font-size: medium;">Date starts: 2023-11-29</h3>
        <form method="get" action="number4.php">
            <input id="input" type="text" name="search" placeholder="yyyy-mm-dd">
            <button type="submit" value="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>
    <ul>
        <?php if($show) { foreach($users as $user): ?>
            <li><?= "User: " . $user['username']?></li>
        <?php  endforeach; }?>
    </ul>
</body>
</html>