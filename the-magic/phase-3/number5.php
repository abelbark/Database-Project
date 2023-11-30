<?php
    $show = false;
    $mysqli = require __DIR__ . '/../database.php';
    $sql = "Select * From user";
    
    $result = $mysqli->query($sql);
    $allUsers = $result->fetch_all(MYSQLI_ASSOC);
if (empty($_GET['userX']) || empty($_GET['userY'])){
    
}else {
    
    $x = $_GET['userX'];
    $y = $_GET['userY'];
    $sql = "Select Distinct ix.username
            FROM item ix
            JOIN reviews rx ON ix.itemID = rx.itemID
            JOIN reviews ry ON rx.itemID = ry.itemID
            Where rx.rating = 'excellent'
            AND ry.rating = 'excellent'
            AND rx.username = '{$x}'
            AND ry.username = '{$y}'";

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
        <form method="get" action="number5.php">
            <select name="userX" id="userx">
                <option value=""> </option>
                <?php foreach($allUsers as $user): ?>
                <option value="<?= $user['username'] ?>"><?= $user['username'] ?></option>
                <?php  endforeach; ?>
            </select>
            <select name="userY" id="usery">
                <option value=""> </option>
                <?php foreach($allUsers as $user): ?>
                <option value="<?= $user['username'] ?>"><?= $user['username'] ?></option>
                <?php  endforeach; ?>
            </select>
            <button type="submit" value="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>
    <ul>
        <?php 
            if($show ) { 
                if(mysqli_num_rows($result) > 0){
                    foreach($users as $user):
                echo "<li>Favorite user: " . $user['username'] . "</li>";
                endforeach; 
                }else {
                echo "No favorite users found.";
                }  
            } 
        ?>
    </ul>
</body>
</html>