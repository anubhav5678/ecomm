<?php include "includes/assets/html-header.php"; displayTitle(getName(escape($_GET['c']))); ?>
<?php
// Code for desroying all the sessions regarding the purchase of a product.
unset($_SESSION['buy_product_code']);
unset($_SESSION['buy_product_size']);
unset($_SESSION['action']);

// Code for setting the sessions for the purchase of a product.
if (isset($_POST['product_size'])) {
    $_SESSION['buy_product_code'] = escape($_GET['c']);
    $_SESSION['buy_product_size'] = escape($_POST['product_size']);
    $_SESSION['action'] = "single";

    // Redirecting the user at order summary page for purchase.
    redirect("order_summary.php");
}
?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Individual page content -->
    <section class="page-content">
        <!-- Navbar of the website -->
        <?php include "includes/assets/navbar.php"; ?>

        <!-- Sidebar for mobiles and tablets. It's invoked when hamburger button is clicked. -->
        <?php include "includes/assets/sidebar.php"; ?>

        <!-- Product section - product's image and product's details. -->
        <?php
        if (isset($_GET['c'])) {
            $p_code = escape($_GET['c']);

            $query = "SELECT * FROM products WHERE product_code = '{$p_code}' ";
        } else {
            redirect("index.php");
        }
        $result = query($query);
        if (mysqli_num_rows($result) == 0 || !$result) {
            redirect("index.php");
        }
        while ($row = mysqli_fetch_assoc($result)) {
            get_product_details($row);
        }
        ?>
        <section class="product-container">
            <main class="product-img">
                <div class="product-img-btns">
                    <?php
                    /* Code for displaying a red heart if the product
                    is in users wishlist and user is logged in. */
                    if (isset($_SESSION['user_code'])) {
                        if (isin_wishlist(escape($_GET['c']))) {
                            echo <<<DELIMETER
                            <div class="heart">
                                <i class="fas fa-heart"></i>
                            </div>
                            DELIMETER;
                        } else {
                            echo <<<DELIMETER
                            <div class="heart">
                                <i class="far fa-heart"></i>
                            </div>
                            DELIMETER;
                        }
                    }
                    ?>
                </div>
                <img src="<?php echo $product_img; ?>" alt="<?php echo $product_name; ?>">
            </main>
            <main class="product-data">
                <h3><?php echo $product_full_name; ?></h3>
                <h3 class="name">₹<?php echo $product_price; ?> <del>₹<?php echo $product_mrp; ?></del> <span class="discount"><?php echo round((($product_mrp - $product_price)/$product_mrp)*100, 0); ?>% off</span></h3>
                <h5 class="discount"><i class="fas fa-tags"></i> You save ₹<?php echo ($product_mrp - $product_price); ?> on this purchase.</h5>
                <h4 class="ratings"><?php echo $product_ratings; ?> <i class="fas fa-star"></i></h4>
                <h5 class="delivery"></h5>
            </main>
            <main class="product-banner">
                <div class="banner-item">
                    <svg style="margin-top: 5.5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M368 0C394.5 0 416 21.49 416 48V96H466.7C483.7 96 499.1 102.7 512 114.7L589.3 192C601.3 204 608 220.3 608 237.3V352C625.7 352 640 366.3 640 384C640 401.7 625.7 416 608 416H576C576 469 533 512 480 512C426.1 512 384 469 384 416H256C256 469 213 512 160 512C106.1 512 64 469 64 416H48C21.49 416 0 394.5 0 368V48C0 21.49 21.49 0 48 0H368zM416 160V256H544V237.3L466.7 160H416zM160 368C133.5 368 112 389.5 112 416C112 442.5 133.5 464 160 464C186.5 464 208 442.5 208 416C208 389.5 186.5 368 160 368zM480 464C506.5 464 528 442.5 528 416C528 389.5 506.5 368 480 368C453.5 368 432 389.5 432 416C432 442.5 453.5 464 480 464z"/></svg>
                    <h5>Free Delivery</h5>
                </div>
                <div class="banner-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M568.2 336.3c-13.12-17.81-38.14-21.66-55.93-8.469l-119.7 88.17h-120.6c-8.748 0-15.1-7.25-15.1-15.99c0-8.75 7.25-16 15.1-16h78.25c15.1 0 30.75-10.88 33.37-26.62c3.25-20-12.12-37.38-31.62-37.38H191.1c-26.1 0-53.12 9.25-74.12 26.25l-46.5 37.74L15.1 383.1C7.251 383.1 0 391.3 0 400v95.98C0 504.8 7.251 512 15.1 512h346.1c22.03 0 43.92-7.188 61.7-20.27l135.1-99.52C577.5 379.1 581.3 354.1 568.2 336.3zM279.3 175C271.7 173.9 261.7 170.3 252.9 167.1L248 165.4C235.5 160.1 221.8 167.5 217.4 179.1s2.121 26.2 14.59 30.64l4.655 1.656c8.486 3.061 17.88 6.095 27.39 8.312V232c0 13.25 10.73 24 23.98 24s24-10.75 24-24V221.6c25.27-5.723 42.88-21.85 46.1-45.72c8.688-50.05-38.89-63.66-64.42-70.95L288.4 103.1C262.1 95.64 263.6 92.42 264.3 88.31c1.156-6.766 15.3-10.06 32.21-7.391c4.938 .7813 11.37 2.547 19.65 5.422c12.53 4.281 26.21-2.312 30.52-14.84s-2.309-26.19-14.84-30.53c-7.602-2.627-13.92-4.358-19.82-5.721V24c0-13.25-10.75-24-24-24s-23.98 10.75-23.98 24v10.52C238.8 40.23 221.1 56.25 216.1 80.13C208.4 129.6 256.7 143.8 274.9 149.2l6.498 1.875c31.66 9.062 31.15 11.89 30.34 16.64C310.6 174.5 296.5 177.8 279.3 175z"/></svg>
                    <h5>Cash On Delivery</h5>
                </div>
                <div class="banner-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M464 16c-17.67 0-32 14.31-32 32v74.09C392.1 66.52 327.4 32 256 32C161.5 32 78.59 92.34 49.58 182.2c-5.438 16.81 3.797 34.88 20.61 40.28c16.89 5.5 34.88-3.812 40.3-20.59C130.9 138.5 189.4 96 256 96c50.5 0 96.26 24.55 124.4 64H336c-17.67 0-32 14.31-32 32s14.33 32 32 32h128c17.67 0 32-14.31 32-32V48C496 30.31 481.7 16 464 16zM441.8 289.6c-16.92-5.438-34.88 3.812-40.3 20.59C381.1 373.5 322.6 416 256 416c-50.5 0-96.25-24.55-124.4-64H176c17.67 0 32-14.31 32-32s-14.33-32-32-32h-128c-17.67 0-32 14.31-32 32v144c0 17.69 14.33 32 32 32s32-14.31 32-32v-74.09C119.9 445.5 184.6 480 255.1 480c94.45 0 177.4-60.34 206.4-150.2C467.9 313 458.6 294.1 441.8 289.6z"/></svg>
                    <h5>7 Days Return Policy</h5>
                </div>
            </main>
            <main class="product-size">
                <h3>Select Size</h3>
                <form id="size_form" action="" method="POST">
                    <?php if($product_sizes == "no-size"): ?>
                        <input type="radio" name="product_size" id="no-size" value="no-size" checked>
                        <label for="no-size">No Size</label>
                    <?php else: ?>
                    <?php
                    $product_sizes = explode(",", $product_sizes);
                    if (count($product_sizes) == 1) {
                        $s = ucfirst($product_sizes[0]);

                        if ($s) { # Displaying the size only if it's not empty.
                            echo <<<DELIMETER
                            <input type="radio" name="product_size" value="{$product_sizes[0]}" id="{$product_sizes[0]}" checked>
                            <label for="{$product_sizes[0]}">{$s}</label>
                            DELIMETER;
                        }
                    } else {
                        /* Exploding the product's size on "," and displaying the sizes. */
                        for ($i=0; $i < count($product_sizes); $i++) {
                            $s = ucfirst($product_sizes[$i]);

                            if ($s) { # Displaying the size only if it's not empty.
                                $size = <<<DELIMETER
                                <input type="radio" name="product_size" value="{$product_sizes[$i]}" id="{$product_sizes[$i]}" required>
                                <label for="{$product_sizes[$i]}">{$s}</label>
                                DELIMETER;
        
                                echo $size;
                            }
                        }
                    }
                    ?>
                    <?php endif; ?>
                </form>
            </main>
            <main class="product-details">
                <h3>Product Details</h3>
                <?php
                /* Getting the product's details and exploding it by "," and displaying it. */
                $product_details = explode(",", $product_details);

                for ($i=0; $i < count($product_details); $i++) {
                    if ($product_details[$i] != "") {
                        echo <<<DELIMETER
                        <div class="product-details-div">
                            <div class="bullet green"></div>
                            <p class="product-details-child">{$product_details[$i]}</p>
                        </div>
                        DELIMETER;
                    }
                }
                ?>
            </main>
            <div class="product-warning">
                <h4></h4>
                <a href="cart.html"></a>
            </div>
            <main class="product-btns">
                <button class="orange" id="add_to_cart"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                <button type="button" form="size_form" id="buy_product" class="green"><i class="fas fa-credit-card"></i> Buy Now</button>
            </main>
            <main class="product-form">
                <h3>Login to continue your shopping</h3>
                <form action="" id="login-form" method="post">
                    <div class="form-group">
                        <label for="user">E-mail Id or Phone Number</label>
                        <div class="input">
                            <input type="text" name="" id="user">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <div class="input">
                            <input type="password" name="" id="pass">
                        </div>
                    </div>
                    <div class="form-group">
                        <h4 id="err"></h4>
                    </div>
                    <div class="form-group">
                        <button type="button" class="submit" id="login-btn">Login</button>
                    </div>
                    <div class="other">
                        <h5>New to Fashion capital?</h5>
                        <a href="signup.html">Create an Account</a>
                    </div>
                </form>
            </main>
            <main class="related-products">
                <h3 class="rel-head">Some Related Products</h3>
                <div class="products_section">
                    <?php
                    /* Displaying some related products in the product page. */
                    $query = query("SELECT * FROM products WHERE product_id > (SELECT product_id FROM products WHERE product_code = '{$p_code}') LIMIT 10");
                    confirmQuery($query);

                    while ($row = mysqli_fetch_assoc($query)) {
                        $p_dis = ($row['product_mrp'] - $row['product_price']);
                        $p_dis_per = round(($p_dis/$row['product_mrp'])*100, 0);
                        $p_name = substr($row['product_name'], 0, 20) . "...";

                        echo <<<DELIMETER
                        <a href="product.php?c={$row['product_code']}" class="product_">
                            <div class="product-img">
                                <img src="{$row['product_img']}" alt="{$row['product_name']}">
                            </div>
                            <div class="product-details">
                                <div class="product-name">
                                    <h4>{$p_name}</h4>
                                </div>
                                <div class="product-price">
                                    <h3><strong><i class="fas fa-rupee-sign"></i>{$row['product_price']}</strong> <small><del><i class="fas fa-rupee-sign"></i>{$row['product_mrp']}</del></small> <small>{$p_dis_per}% off</small></h3>
                                </div>
                                <div class="product-tag">
                                    <h3><i class="fas fa-tags"></i> You save ₹{$p_dis}</h3>
                                </div>
                                <div class="product-rate">
                                    <h3>{$row['product_ratings']} <i class="fas fa-star"></i></h3>
                                </div>
                                <div class="product-stats">
                                    <strong>Free Delivery <i class="fas fa-truck"></i></strong>
                                </div>
                            </div>
                        </a>
                        DELIMETER;
                    }
                    ?>
                </div>
            </main>
        </section>
    </section>
</body>
<script>
    const u = "<?php echo isset($_SESSION['user_code']) ? $_SESSION['user_code'] : "" ?>";
    const c = "<?php echo escape($_GET['c']); ?>";
</script>
<script src="js/script.js"></script>
<script src="js/product.js"></script>
</html>