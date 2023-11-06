<?php 

function addReview($product_id, $user_id, $rating, $description) {
 Check if the user is reviewing their own item
    $product_owner = // Query to get the product owner (owner_id) based on product_id

    if ($product_owner == $user_id) {
        return "You cannot review your own item.";
    }

    
    $date = date('Y-m-d');
    $reviewCount = 

    if ($reviewCount >= 3) {
        return "You have reached your daily review limit.";
    }

  
    $query = 
    
    return "Review added successfully.";
}


$product_id = 
$user_id = 
$rating = 
$description = 
$result = addReview($product_id, $user_id, $rating, $description);
echo $result;
?>
