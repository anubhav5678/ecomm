<?php
include("../config/db.php");
include("../config/functions.php");

// Code for getting the action request and doing queries on the basis of value.
if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'increment':
            // Code for incrementing the quantity of a product in the cart of a user.
            if (isset($_REQUEST['code'])) {
                $p_code = escape($_REQUEST['code']);
                $p_size = escape($_REQUEST['size']);
                $query = query("UPDATE cart SET product_quantity = product_quantity + 1 WHERE cart_product_code = '{$p_code}' AND user_code = '{$_SESSION['user_code']}' AND product_size = '{$p_size}' ");
                confirmQuery($query);
                echo "Incremented";
            }
            break;

        case 'decrement':
            // Code for incrementing the quantity of a product in the cart of a user.
            if (isset($_REQUEST['code'])) {
                $p_code = escape($_REQUEST['code']);
                $p_size = escape($_REQUEST['size']);
                $query = query("UPDATE cart SET product_quantity = product_quantity - 1 WHERE cart_product_code = '{$p_code}' AND user_code = '{$_SESSION['user_code']}' AND product_size = '{$p_size}' ");
                confirmQuery($query);
                echo "Decremented";
            }
            break;
        
        case 'getQuantity':
            // Code for getting the product's quantity in cart of a user.
            if (isset($_REQUEST['code'])) {
                $p_code = escape($_REQUEST['code']);
                $p_size = escape($_REQUEST['size']);

                $query = query("SELECT product_quantity FROM cart WHERE cart_product_code = '{$p_code}' AND user_code = '{$_SESSION['user_code']}' AND product_size = '{$p_size}' ");
                confirmQuery($query);
                $row = mysqli_fetch_assoc($query);

                echo $row['product_quantity'];
            }
            break;

        case 'deleteProduct':
            // Code for deleting a product from cart of a specific user with product's code.
            if (isset($_REQUEST['code'])) {
                $p_code = escape($_REQUEST['code']);
                $p_s = escape($_REQUEST['size']);

                $query = query("DELETE FROM cart WHERE cart_product_code = '{$p_code}' AND user_code = '{$_SESSION['user_code']}' AND product_size = '{$p_s}'");
                confirmQuery($query);
                echo "deleted";
            }
            break;

        case 'addToCart':
            // Code for adding a product to the cart.
            if (isset($_REQUEST['code'])) {
                $p_c = escape($_REQUEST['code']);
                $p_s = escape($_REQUEST['size']);

                if (!is_product_in_cart($_SESSION['user_code'], $p_c, $p_s)) {
                    $query = "INSERT INTO cart(user_code, cart_product_code, product_quantity, product_size) VALUES ('{$_SESSION['user_code']}', '{$p_c}', '1', '{$p_s}') ";
                    mysqli_query($connection, $query);
                }
            }
            break;

        case 'getCartNum':
            // Code for getting the number of products in cart of a user.
            if (isset($_SESSION['user_code'])) {
                $query = query("SELECT cart_id FROM cart WHERE user_code = '{$_SESSION['user_code']}' ");
                confirmQuery($query);
                $product_num = 0;
                if (mysqli_num_rows($query) == 0) {
                    echo 0; 
                }
                else {
                    echo mysqli_num_rows($query);
                }
            } else {
                echo 0;
            }
            break;

        // Code for updating the product's quantity in the cart of a user.
        case 'editQuantity':
            if (isset($_REQUEST['code'])) {
                $p_c = escape($_REQUEST['code']);
                $p_quan = escape($_REQUEST['productQuantity']);
                $p_size = escape($_REQUEST['size']);

                $query = query("UPDATE cart SET product_quantity = '{$p_quan}' WHERE cart_product_code = '{$p_c}' AND user_code = '{$_SESSION['user_code']}' AND product_size = '{$p_size}' ");
                confirmQuery($query);
            }
            break;

        // Code for getting the price details of products in the cart of a user.
        case 'getPriceDetails':
            $query = query("SELECT product_price, product_mrp, product_quantity FROM cart INNER JOIN products ON cart.cart_product_code = products.product_code WHERE cart.user_code = '{$_SESSION['user_code']}' ORDER BY cart_id DESC ");
            $total_products = mysqli_num_rows($query);
            $total_price = 0;
            $total_discount = 0;
            
            while ($row = mysqli_fetch_assoc($query)) { // Getting the total price and total discount.
                $total_price += ($row['product_mrp'] * $row['product_quantity']);
                $total_discount += (($row['product_mrp'] * $row['product_quantity']) - ($row['product_price'] * $row['product_quantity']));
            }

            $total_amount = $total_price - $total_discount;
            $price_details = [
                "total_products" => $total_products,
                "total_price" => $total_price,
                "total_discount" => $total_discount,
                "total_amount" => $total_amount
            ];

            $price_details = json_encode($price_details);
            echo $price_details;
            break;

        // Code for getting the price details of a single product for order summary page.
        case 'getSinglePrice':
            $query = query("SELECT * FROM products WHERE product_code = '{$_POST['code']}' ");
            confirmQuery($query);

            while ($row = mysqli_fetch_assoc($query)) {
                $price = $row['product_mrp'];
                $amount = $row['product_price'];
            }

            $price_details = [
                "price" => $price,
                "amount" => $amount
            ];

            $price_details = json_encode($price_details);
            echo $price_details;
            break;
    }
}
?>