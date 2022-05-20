<?php include("includes/assets/html-header.php"); displayTitle("Order Summary"); ?>
<?php
/* Code for sending user to the index or previous
page when user goes to order summary page. */
if (empty($_SESSION['user_code']) || empty($_SESSION['action'])) {
    if (isset($_SERVER['HTTP_REFERER'])) {
        redirect($_SERVER['HTTP_REFERER']);
    } else {
        redirect("index.php");
    }
}
else if (!address_registered($_SESSION['user_code'])) {
    redirect("add_address.php");
}
?>
<body>
    <?php
    /* Code for getting all the products information the user is going
    to buy adding adding it to the orders table. */
    if (isset($_POST['payment_method'])) {
        $pay_method = escape($_POST['payment_method']); // Getting the mode of payment.

        // Code for getting the product code and quantity for the order.
        // $orders = [];
        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 8) == "product_") {
                $d = explode("_", $value);
                $c = substr($key, 8);
                $s = $d[0];
                $q = $d[1];

                echo "Size" . $s . "<br>";
                echo "Quantity" . $q . "<br>";
                // Querying for each product.
                $query = "INSERT INTO `orders`(`user_code`, `product_code`, `product_quantity`, `product_size`, `order_mod_of_pay`, `order_user_status`, `order_date`) ";
                $query .= "VALUES ('{$_SESSION['user_code']}', '{$c}', '{$q}', '{$s}', '{$pay_method}', 'ordered', NOW()) ";
                $query = query($query);
                confirmQuery($query);
                // array_push($orders, mysqli_insert_id($connection));
                
                // Removing all the products from the cart of user after purchase/order.
                if ($_SESSION['action'] == "cart") {
                    $query = query("DELETE FROM cart WHERE user_code = '{$_SESSION['user_code']}'");
                    confirmQuery($query);
                }

                unset($_SESSION['action']);
                $_SESSION['referer'] = "ordered"; // Setting the session for getting to the thankyou page.
                // $_SESSION['orders'] = $orders; // Setting the session for all the orders for the thankyou page.
                redirect("thankyou.php"); // Redirecting uder at thank you page after order.
            }
        }
    }
    ?>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Order Summary page content -->
    <section class="page-content">
        <!-- The summary order navbar -->
        <?php include("includes/assets/navbar-sl.php"); nav("Order Summary"); ?>

        <!-- Order Summary -->
        <section class="order-summary">
            <main class="summary-address">
                <h3>Deliver at:</h3>
                <?php
                // Code for getting the user address on the page.
                $query = "SELECT house_num, road_name, landmark, pincode, city, state, user_full_name, user_phnum, users.user_code ";
                $query .= "FROM addressess INNER JOIN users ON addressess.user_code = users.user_code ";
                $query .= "WHERE users.user_code = '{$_SESSION['user_code']}' AND addressess.user_code = '{$_SESSION['user_code']}' ";
                $query = query($query);
                confirmQuery($query);

                while ($row = mysqli_fetch_assoc($query)) {
                    $address = <<<DELIMETER
                    <h4>{$row['user_full_name']}</h4>
                    <p>{$row['house_num']}, {$row['road_name']}, {$row['landmark']}</p>
                    <p>{$row['city']}, {$row['state']} - {$row['pincode']}</p>
                    <h4>{$row['user_phnum']}</h4>
                    DELIMETER;

                    echo $address;
                }
                ?>
            </main>
            <main class="cart-products">
                <h3>Products you are ordering:</h3>
                <?php
                // Code for getting the products data in the cart or to order.

                switch ($_SESSION['action']) {
                    case 'single': // Code executes when a single product is to be purchased.
                        $p_code = $_SESSION['buy_product_code'];
                        $p_size = $_SESSION['buy_product_size'];
                        if ($p_size == "no-size") { // Formating the product's size.
                            $fp_size = "No size";
                        }
                        else {
                            $fp_size = ucfirst($p_size);
                        }

                        $query = query("SELECT * FROM products WHERE product_code = '{$p_code}' ");
                        confirmQuery($query);

                        // Showing product(s) to be purchased.
                        while ($row = mysqli_fetch_assoc($query)) {
                            $product_discount = ceil((($row['product_mrp'] - $row['product_price']) / $row['product_mrp']) * 100);

                            $product = <<<DELIMETER
                            <div class="cart-product" style="padding-bottom: 10px;">
                                <div class="product-data">
                                    <input form="buy_product" type="hidden" name="product_{$p_code}" value="{$p_size}_1">
                                    <h4 class="product-title">{$row['product_name']}</h4>
                                    <h5>Size: {$fp_size}, Qty: 1</h5>
                                    <h5 class="ratings">{$row['product_ratings']} <i class="fas fa-star" aria-hidden="true"></i></h5>
                                    <h3 class="product-title">₹{$row['product_price']} <del>₹{$row['product_mrp']}</del> <span class="discount">{$product_discount}% off</span></h3>
                                    <h5 class="delivery">Delivery by Thursday 17 Mar | <span class="discount">Free</span></h5>
                                </div>
                                <div class="product-img">
                                    <img src="{$row['product_img']}" width="75px" alt="Product Image">
                                </div>
                            </div>
                            DELIMETER;

                            echo $product;
                        }
                        break;

                    case 'cart': // Code executes when the products of cart is to be purchased.
                        $query = query("SELECT * FROM cart INNER JOIN products ON cart.cart_product_code = products.product_code WHERE cart.user_code = '{$_SESSION['user_code']}' ORDER BY cart_id DESC ");
                        confirmQuery($query);

                        // Showing product(s) to be purchased.
                        while ($row = mysqli_fetch_assoc($query)) {
                            $product_discount = ceil((($row['product_mrp'] - $row['product_price']) / $row['product_mrp']) * 100);
                            $product_size = trim($row['product_size']);
                            // Formating text if it's no size
                            if ($row['product_size'] == "no-size") {
                                $product_size = "No size";
                            } else {
                                $product_size = ucfirst($product_size);
                            }

                            $product = <<<DELIMETER
                            <div class="cart-product" style="padding-bottom: 10px;">
                                <div class="product-data">
                                    <input form="buy_product" type="hidden" name="product_{$row['product_code']}" value="{$row['product_size']}_{$row['product_quantity']}">
                                    <h4 class="product-title">{$row['product_name']}</h4>
                                    <h5>Size: {$product_size}, Qty: {$row['product_quantity']}</h5>
                                    <h5 class="ratings">{$row['product_ratings']} <i class="fas fa-star" aria-hidden="true"></i></h5>
                                    <h3 class="product-title">₹{$row['product_price']} <del>₹{$row['product_mrp']}</del> <span class="discount">{$product_discount}% off</span></h3>
                                    <h5 class="delivery">Delivery by Thursday 17 Mar | <span class="discount">Free</span></h5>
                                </div>
                                <div class="product-img">
                                    <img src="{$row['product_img']}" width="75px" alt="Product Image">
                                </div>
                            </div>
                            DELIMETER;

                            echo $product;
                        }
                        break;
                }
                ?>
            </main>
            <main class="price-details" id="price-details">
                <h4>Price Details</h4>
                <ul>
                    <li>
                        <span id="product-quantity"></span>
                        <span id="total-price"></span>
                    </li>
                    <li>
                        <span>Discount</span>
                        <span class="discount" id="total-discount"></span>
                    </li>
                    <li>
                        <span>Delivery Charges</span>
                        <span class="discount" id="delivery-charge"></span>
                    </li>
                </ul>
                <h4>
                    <span>Total Amount</span>
                    <span class="total-amount"></span>
                </h4>
                <h5 class="discount"></h5>
            </main>
            <form action="" method="POST" id="buy_product" class="payments">
                <h4>All Payments Options</h4>
                <label class="input">
                    <input form="buy_product" type="radio" name="payment_method" value="cod">
                    <span>COD</span>
                </label>
            </form>
            <div class="product-warning"></div>
            <div class="place-order-dk">
                <a href="#price-details">
                    <h4 class="total-amount"></h4>
                    <h6>View price details</h6>
                </a>
                <button name="buy_btn" class="continue-btn">Continue</button>
            </div>
        </section>
        <section class="place-order-ml">
            <a href="#price-details">
                <h4 class="total-amount"></h4>
                <h6>View price details</h6>
            </a>
            <button name="buy_btn" class="continue-btn">Continue</button>
        </section>
    </section>
</body>
<script>
    var o = "<?php echo isset($_SESSION['action']) ? $_SESSION['action'] : "" ?>";
    <?php
    if ($_SESSION['action'] == "single") {
        echo <<<DELIMETER
        var c = "{$_SESSION['buy_product_code']}";
        DELIMETER;
    }
    ?>
</script>
<script src="js/orderSummary.js"></script>
</html>