<?php
    $databasePath = __DIR__ . '/../database.php';
    $mysqli = require $databasePath;

    $sql = "SELECT DISTINCT u.username
            FROM user u   
            WHERE EXISTS (
                SELECT 1
                from reviews r
                where r.userName = u.username 
                group by r.userName
                having count(*) > 0
                and MAX(r.rating = 'poor') = count(*)

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
    <title>Number 8</title>
</head>
<body>
    <h1>8) Users who posted some reviews but each of them is "poor"</h1>
    <ul>
        <?php  foreach($users as $user): ?>
            <li><?= $user['username']; ?></li>
        <?php  endforeach; ?>
    </ul>
</body>
</html>