<?php
include("../config/db.php");
include("../config/functions.php");

// Getting the request of adding or removing the product.
if (isset($_REQUEST['action'])) {
    $c = escape($_REQUEST['code']); // Getting the product code to add/remove in wishlist.
    switch ($_REQUEST['action']) {
        // Adding the product to wishlist.
        case 'add':
            if (!isin_wishlist($c)) {
                $query = "INSERT INTO `wishlist`(`user_code`, `product_code`) ";
                $query .= "VALUES ('{$_SESSION['user_code']}', '{$c}')";
                $query = query($query);
                confirmQuery($query);
                }
            break;

        // Removing the product to wishlist.
        case 'remove':
            if (isin_wishlist($c)) {
                $query = query("DELETE FROM wishlist WHERE user_code = '{$_SESSION['user_code']}' AND product_code = '{$c}' ");
                confirmQuery($query);
            }
            break;
    }
}
?>