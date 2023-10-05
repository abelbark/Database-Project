
<?php
    session_start();

    if(isset($_SESSION["first-name"])){

        $firstName = $_SESSION["first-name"];

    } else {

        header('Location: main.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Arrival</title>
</head>
<body>

    <div class="welcome-header">
        <h1>Welcome <?php echo $firstName; ?></h1>
    </div>

    
    <!--check if the user is logged in-->
 
    <div class="crowd-container">
        <img src="https://media1.giphy.com/media/35AZzA7QYVyxhvnGU6/giphy.gif?cid=6c09b952o0fek76twqaqi64msv0nwuumuim6nm4an7urngsu&ep=v1_internal_gif_by_id&rid=giphy.gif&ct=s"
         id="crowd" name="crowd-cheer">
    </div>
    
</body>
</html>

