<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="phase3.css">
    <title>Document</title>
</head>
<body>
    <script>
        function goBack() {
            location.href = '../arrival.php';
        }
    </script>
    <div class="back"><button onclick="goBack()"><i class='bx bx-arrow-back'> Back to Arrival</i></button></div>

    <div class="container">

        <div class="phase3buttons">
            <form action="number1.php" method="post">
                <input type="submit" name="number1" value="Most expensive items in each category" class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number2.php" method="post">
                <input type="submit" name="number2" value='Users who posted two items that were posted on the same day in 2 categories' class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number3.php" method="post">
                <input type="submit" name="number3" value='All items posted by user x, who&#39s comments are "Excellent" or "good"' class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number4.php" method="post">
                <input type="submit" name="number4" value='User(s) with most number of posted items on specific date' class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number5.php" method="post">
                <input type="submit" name="number5" value='List user(s) who are favorited by both user x and user y' class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number6.php" method="post">
                <input type="submit" name="number6" value='Users who never posted an "Excellent" item ' class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number7.php" method="post">
                <input type="submit" name="number7" value='Users who never posted a "poor" review' class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number8.php" method="post">
                <input type="submit" name="number8" value='Users who posted only "poor" reviews' class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number9.php" method="post">
                <input type="submit" name="number9" value='Users who have posted items that dont have "poor" reviews' class="forms">
            </form>
        </div>

        <div class="phase3buttons">
            <form action="number10.php" method="post">
                <input type="submit" name="number10" value='List of pair of users who have given each other "Excellent" for every item they have posted' class="forms">
            </form>
        </div>

    </div>
</body>
</html>