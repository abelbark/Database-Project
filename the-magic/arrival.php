
<?php

    include "createItem.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/gondrin" rel="stylesheet">
    <link rel="stylesheet" href="item.css">
    <title>Arrival</title>

    <script>

        var theItem;
        var itemPrice;

        function init(){

            theItem = document.getElementById("item-box");
            itemPrice = document.getElementById("item-price");

            itemPrice.value = "0.00";

            itemPrice.addEventListener("input", formatMoney);

        }

        function makeItemBoxVisisble(){
            theItem.style.display = "flex";
        }


        function formatMoney(){

            var input = itemPrice.value;
            input = input.replace(/[^\d.]/g, "");
            var parts = input.split(".");
            var decimalPart = parts[1];

            if(!decimalPart || decimalpart.length != 2){
                alert("Format must be 'x.xx'");
                itemPrice.value = "0.00";
                event.preventDefault();
            }

            
        }


        window.addEventListener("load", init);
    </script>


</head>
<body>

    <div class="arrival-container">
        

        <div class="header-container">
            <h3 id="create-header">Item</h3>
        </div>

        <div class="input-form">
            <!-- SignUp form-->
            <div id="item-box">
                <form action="createItem.php" method="post">
                    <div class="item-input">
                        <input type="text" 
                            id="item-name" 
                            placeholder="Item Name" 
                            name="item-name"><br>
                        <input type="text" 
                            id="item-category" 
                            placeholder="Item Category" 
                            name="item-category"><br>
                         <input type="text" 
                            id="item-price"
                            placeholder="0.00" 
                            name="item-price"><br>
                        <textarea
                            id="item-description"
                            placeholder="Item description"
                            name="item-description"></textarea><br>

                        <input type="submit" id="create" value="Create">
                        <p><a href="arrival.php?logout=1">Log Out</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>

