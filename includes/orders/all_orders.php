<?php
// Code for getting all the orders of a user.
$query = query("SELECT * FROM orders INNER JOIN products ON orders.product_code = products.product_code WHERE user_code = '{$_SESSION['user_code']}' ORDER BY orders.order_id DESC ");
confirmQuery($query);
?>
<?php
if (mysqli_num_rows($query) != 0): ?>
<section class="orders">
    <?php
    // Displaying all the orders of a user.
    while ($row = mysqli_fetch_assoc($query)) {
        $product_discount = ceil((($row['product_mrp'] - $row['product_price']) / $row['product_mrp']) * 100);
        $product_size = trim($row['product_size']);
        // Formating the size of a product.
        if ($product_size == "no-size") {
            $product_size = "No Size";
        } else {
            $product_size = ucfirst($product_size);
        }

        // Formating the expected delivery date of the product.
        $d_date = new DateTime($row['order_date']);
        $d_date = $d_date->modify("+7 day");
        $d_date = $d_date->format("D d F");

        // Formating the order date.
        $o_date = new DateTime($row['order_date']);
        $o_date = $o_date->format("D d F");

        // Formating the exact delivery date of an order.
        if (isset($row['order_delivery_date'])) {
            $ed_date = new DateTime($row['order_delivery_date']);
            $ed_date = $ed_date->format("D d F");
        }

        // Formating the date of user demand on order.
        if (isset($row['order_user_date'])) {
            $ud_date = new DateTime($row['order_user_date']);
            $ud_date = $ud_date->format("D d F");
        }

        // Displaying the user controls over the order and the order status.
        switch ($row['order_user_status']) {
            case 'ordered':
                $txt = <<<DELIMETER
                <h5 class="discount"><div class="bullet green"></div> To be delivered by {$d_date}</h5>
                DELIMETER;
                $btn = <<<DELIMETER
                <button class="cancel">Cancel</button>
                DELIMETER;
                break;
            
            case 'delivered':
                $txt = <<<DELIMETER
                <h5 class="discount"><div class="bullet green"></div> Delivered on {$ed_date}</h5>
                DELIMETER;

                /* Code for checking that a product is delivered 7 days 
                ago or not - Checking that it could be returned or not. */
                $deld = date_create($row['order_delivery_date']); # Delivery Date.
                $tod = date_create("now"); # Present date.

                $diff = date_diff($deld, $tod); # Difference of the two dates.
                $diff = (int) $diff->format("%a"); # Formating the date and getting the number of days past.

                // Checking if it's been 7 days.
                if ($diff >= 7) {
                    $btn = ""; # No button is displayed.
                } else {
                    # Return button is displayed.
                    $btn = <<<DELIMETER
                    <button class="return">Return</button>
                    DELIMETER;
                }
                break;

            case 'cancelled':
                $txt = <<<DELIMETER
                <h5 class="warning"><div class="bullet red"></div> Cancelled on {$ud_date}</h5>
                DELIMETER;
                $btn =  "";
                break;

            case 'returned':
                $txt = <<<DELIMETER
                <h5 class="warning"><div class="bullet red"></div> Returned on {$ud_date}</h5>
                DELIMETER;
                $btn =  "";
                break;
        }

        // The order of a user.
        $order = <<<DELIMETER
        <main class="order_{$row['order_id']}">
            <div class="order-data">
                <h4 class="product-title">{$row['product_name']}</h4>
                <h5>Qty: {$row['product_quantity']}, Size: {$product_size}</h5>
                <h5 class="discount"><div class="bullet green"></div> Ordered on {$o_date}</h5>
                <h3 class="product-title">₹{$row['product_price']} <del>₹{$row['product_mrp']}</del> <span class="discount">{$product_discount}% off</span></h3>
                <h5>{$txt}</h5>
            </div>
            <a href="product.php?c={$row['product_code']}" class="order-img">
                <img src="{$row['product_img']}" alt="{$row['product_name']}">
            </a>
            {$btn}
        </main>
        DELIMETER;

        echo $order;
    }
    ?>
</section>
<?php else: ?>
    <?php include("includes/orders/warning.php"); warning("You haven't ordered yet!"); ?>
<?php endif; ?>