<?php
    $show = false;
if (empty($_GET['search1']) || empty($_GET['search2'])){
    
}else {
    $mysqli = require __DIR__ . '/../database.php';
    $x = $_GET['search1'];
    $y = $_GET['search2'];
    $sql = "SELECT * From user u where Exists (
                Select 1
                From item i1
                where i1.username = u.username And i1.category = '{$x}' 
                and Exists (
                    Select 1
                    From item i2
                    where i2.username = u.username
                    And i2.category = '{$y}'
                    And DATE(i1.postDate) = DATE(i2.postDate)
                    And i1.itemId <> i2.itemID
                )
            );
    ";
    
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
    <title>2</title>
</head>
<body>
    <div class="search">
        <form method="get" action="number2.php">
            <input type="text" name="search1" placeholder="Category X">
            <input type="text" name="search2" placeholder="Category Y">
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