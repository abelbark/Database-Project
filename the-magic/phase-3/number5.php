<?php
    $show = false;
if (empty($_GET['search1']) || empty($_GET['search2'])){
    
}else {
    $mysqli = require __DIR__ . '/../database.php';
    $x = $_GET['search1'];
    $y = $_GET['search2'];
    $sql = "";
    
    $result = $mysqli->query($sql);

    if($result){
        $show = true;
        $users = $result->fetch_all(MYSQLI_ASSOC);
        
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
    <title>5</title>
</head>
<body>
    <script>
        function goBack() {
            location.href = 'phase3.php';
        }
    </script>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Phase3 </i></button></div>
    <div class="search">
        <form method="get" action="number2.php">
            <input type="text" name="search1" placeholder="User X">
            <input type="text" name="search2" placeholder="User Y">
            <button type="submit" value="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>
    <ul>
        <?php if($show) { foreach($users as $user): ?>
            <li><?= "User: " . $user['username'] ?></li>
        <?php  endforeach; }?>
    </ul>
</body>
</html>