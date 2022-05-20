<?php include "includes/assets/html-header.php"; displayTitle("My Cart"); ?>
<?php if (!isset($_SESSION['user_code'])) redirect("login.php"); ?>
<body>
    <?php
    // Code for desroying all the sessions regarding the purchase of a product.
    unset($_SESSION['buy_product_code']);
    unset($_SESSION['buy_product_size']);
    unset($_SESSION['action']);

    /* Code for sending the user on order summary page 
    when the user clicks on Place order button */
    if (isset($_POST['buy'])) {
        $_SESSION['action'] = "cart";
        redirect("order_summary.php");
    }
    ?>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Cart -->
    <section class="page-content">
        <!-- Navbar of the website -->
        <?php include "includes/assets/navbar.php"; ?>

        <!-- Sidebar for mobiles and tablets. It's invoked when hamburger button is clicked. -->
        <?php include "includes/assets/sidebar.php"; ?>

        <!-- Cart container -->
        <?php if(get_cart_num() !== 0): // Code for checking that a user has empty cart or not. ?>
        <section class="cart">
            <!-- The Products in the cart of a user. -->
            <main class="cart-products">
                <?php
                if (isset($_SESSION['user_code'])) {
                    $query = query("SELECT * FROM cart INNER JOIN products ON cart.cart_product_code = products.product_code WHERE cart.user_code = '{$_SESSION['user_code']}' ORDER BY cart_id DESC ");
                    confirmQuery($query);
                } else {
                    redirect("index.php");
                }

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
                    <div class="cart-product c_{$row['product_code']} s_{$row['product_size']}">
                        <!-- A single product in the cart. -->
                        <div class="product-data">
                            <!-- The data regarding product in the cart. -->
                            <h4 class="product-title">{$row['product_name']}</h4>
                            <h5>Size: {$product_size}</h5>
                            <h5 class="ratings">{$row['product_ratings']} <i class="fas fa-star" aria-hidden="true"></i></h5>
                            <h3 class="product-title">₹{$row['product_price']} <del>₹{$row['product_mrp']}</del> <span class="discount">{$product_discount}% off</span></h3>
                            <h5 class="delivery">Delivery by Thursday 17 Mar | <span class="discount">Free</span></h5>
                        </div>
                        <!-- The image and increment/decrement buttons of the product in the cart. -->
                        <div class="product-img">
                            <a href="product.php?c={$row['product_code']}"><img src="{$row['product_img']}" width="75px" alt="Product Image"></a>
                            <div class="controls">
                                <button class="decre_">-</button>
                                <input type="number" name="product_quantity" class="product_quantity_{$row['product_code']}_{$row['product_size']}" value="{$row['product_quantity']}">
                                <button class="incre_">+</button>
                            </div>
                        </div>
                        <div class="warning_"></div>
                        <!-- The remove product button. -->
                        <div class="product-button">
                            <button class="del_"><i class="fas fa-trash-alt" aria-hidden="true"></i> Remove</button>
                        </div>
                    </div>
                    DELIMETER;

                    echo $product;
                }
                ?>
            </main>
            <!-- The price details of products in the cart. -->
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
                <!-- The place order button for computers. -->
                <div class="place-order-dk">
                    <button name="buy" form="cart-form" class="continue-btn">Checkout</button>
                </div>
            </main>
        </section>
        <!-- The place order button for mobile devices. -->
        <section class="place-order-ml">
            <form action="" method="POST" id="cart-form" style="display: none;"></form>
            <a href="#price-details">
                <h4 class="total-amount"></h4>
                <h6>View price details</h6>
            </a>
            <button name="buy" form="cart-form" class="continue-btn">Checkout</button>
        </section>
        <?php else: ?>
        <section class="cart-empty-warning">
            <h1>Your cart is empty!</h1>
            <img src="img/empty_cart.webp" width="100px" alt="">
            <a class="a-link" href="index.php">Continue Shopping</a>
        </section>
        <?php endif; ?>
    </section>
</body>
<script src="js/script.js"></script>
<script src="js/cart.js"></script>
</html>