<?php
    $databasePath = __DIR__ . '/../database.php';
    $mysqli = require $databasePath;

    $sql = "SELECT DISTINCT u.username
            FROM user u   
            WHERE NOT EXISTS (
                SELECT 1
                from item i
                where i.username  = u.username 
                and exists(
                    SELECT 1
                    from reviews r
                    where r.itemID = i.itemID
                    and r.rating = 'poor'
                )

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
    <title>9</title>
</head>
<body>
    <script>
        function goBack() {
            location.href = 'phase3.php';
        }
    </script>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Phase3</i></button></div>
    <h1>9) Users who have posted items that havent recieved a "poor" review</h1>
    <ul>
        <?php  foreach($users as $user): ?>
            <li><?= $user['username']; ?></li>
        <?php  endforeach; ?>
    </ul>
</body>
</html>