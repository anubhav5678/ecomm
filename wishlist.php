<?php include "includes/assets/html-header.php"; displayTitle("My Wishlist"); ?>
<?php if (!isset($_SESSION['user_code'])) redirect("login.php"); ?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Wishlist page content -->
    <section class="page-content">
        <!-- Navbar of the website -->
        <?php include "includes/assets/navbar.php"; ?>

        <!-- Sidebar for mobiles and tablets. It's invoked when hamburger button is clicked. -->
        <?php include "includes/assets/sidebar.php"; ?>

        <!-- Products section of wishlist page -->
        <?php if(get_wishlist_num() !== 0): // Code for checking that a user has empty wishlist or not. ?>
        <section class="cart wishlist">
            <main class="cart-products">
                <?php
                $query = query("SELECT * FROM wishlist INNER JOIN products ON wishlist.product_code = products.product_code WHERE wishlist.user_code = '{$_SESSION['user_code']}' ORDER BY id DESC");
                confirmQuery($query);

                while ($row = mysqli_fetch_assoc($query)) {
                    $product_discount = ceil((($row['product_mrp'] - $row['product_price']) / $row['product_mrp']) * 100);

                    $product = <<<DELIMETER
                    <div class="cart-product">
                        <!-- A single product in the wishlist of a user. -->
                        <div class="product-data">
                            <!-- The data regarding product in the wishlist. -->
                            <h4 class="product-title">{$row['product_name']}</h4>
                            <h5 class="ratings">{$row['product_ratings']} <i class="fas fa-star" aria-hidden="true"></i></h5>
                            <h3 class="product-title">₹{$row['product_price']} <del>₹{$row['product_mrp']}</del> <span class="discount">{$product_discount}% off</span></h3>
                        </div>
                        <!-- The image of the product in the wishlist. -->
                        <div class="product-img">
                            <a href="product.php?c={$row['product_code']}"><img src="{$row['product_img']}" width="75px" alt="Product Image"></a>
                        </div>
                        <div id="warning_{$row['product_code']}"></div>
                        <!-- The remove product button. -->
                        <div class="product-button wishlist">
                            <button id="remove_{$row['product_code']}"><i class="fas fa-trash-alt" aria-hidden="true"></i> Remove</button>
                        </div>
                    </div>
                    DELIMETER;

                    echo $product;
                }
                ?>
            </main>
        </section>
        <?php else: ?>
        <section class="cart-empty-warning">
            <h1>Your wishlist is empty!</h1>
            <img src="img/empty_cart.webp" width="100px" alt="">
            <a class="a-link" href="index.php">Continue Shopping</a>
        </section>
        <?php endif; ?>
    </section>
</body>
<script src="js/script.js"></script>
<script src="js/wishlist.js"></script>
</html>