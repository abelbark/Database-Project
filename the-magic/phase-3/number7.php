
<?php
    $databasePath = __DIR__ . '/../database.php';
    $mysqli = require $databasePath;

    $sql = "SELECT DISTINCT u.username
            FROM user u   
            WHERE NOT EXISTS (
                SELECT 1
                from reviews r
                join item i on r.itemID = i.itemID
                where r.userName = u.username and r.rating = 'poor'
            )";
    $result = $mysqli->query($sql);

    if($result){
        $users = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        die($mysqli->error);
    }

    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7</title>
</head>
<body>
    <h1>7) Users who never posted a "poor" review</h1>
    <ul>
        <?php  foreach($users as $user): ?>
            <li><?= $user['username']; ?></li>
        <?php  endforeach; ?>
    </ul>
</body>
</html>