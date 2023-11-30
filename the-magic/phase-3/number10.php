<?php
$databasePath = __DIR__ . '/../database.php';
$mysqli = require $databasePath;

$sql = "SELECT DISTINCT r1.userName AS userA, r2.userName AS userB
        FROM reviews r1
        JOIN reviews r2 ON r1.itemID = r2.itemID AND r1.userName < r2.userName
        WHERE r1.rating = 'excellent' AND r2.rating = 'excellent'
        GROUP BY userA, userB
        HAVING COUNT(DISTINCT r1.itemID) = (SELECT COUNT(DISTINCT itemID) FROM reviews WHERE userName = userA)
        AND COUNT(DISTINCT r2.itemID) = (SELECT COUNT(DISTINCT itemID) FROM reviews WHERE userName = userB);";

$result = $mysqli->query($sql);

if ($result) {
    $userPairs = $result->fetch_all(MYSQLI_ASSOC);
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
    <title>Number 10</title>
</head>
<body>
    <script>
        function goBack() {
            location.href = 'phase3.php';
        }
    </script>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Phase3</i></button></div>
    <h1>Pair that always give each other "excellent" reviews for every item they posted</h1>
    <h1>10) Pair that always give each other "excellent" reviews for every item they posted</h1>
    <ul>
        <?php foreach ($userPairs as $pair): ?>
            <li><?= $pair['userA']; ?> and <?= $pair['userB']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
