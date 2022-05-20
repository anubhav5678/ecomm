<?php
include("../config/db.php");
include("../config/functions.php");

// Code for geting the action and order id to update an order in database.
if (isset($_POST['a'])) {
    switch ($_POST['a']) {
        // Cancelling an order on a user's request with the order id.
        case "cancel":
            $c = escape($_POST['c']);
            $query = query("UPDATE orders SET order_user_status = 'cancelled', order_user_date = NOW() WHERE order_id = '{$c}' ");
            confirmQuery($query);
            break;

        // Returning a product on a user's request with the order id.
        case "return":
            $c = escape($_POST['c']);
            $query = query("UPDATE orders SET order_user_status = 'returned', order_user_date = NOW() WHERE order_id = '{$c}' ");
            confirmQuery($query);
            break;
    }
} else {
    redirect("../index.php");
}?>