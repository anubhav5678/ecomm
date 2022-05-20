<?php include "includes/assets/html-header.php"; displayTitle("Buy " . escape($_GET['q']) . " on Fashion Capital at Very Low Prices."); ?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Search page content -->
    <section class="page-content">
        <!-- Navbar of the website -->
        <?php include "includes/assets/navbar.php"; ?>

        <!-- Sidebar for mobiles and tablets. It's invoked when hamburger button is clicked. -->
        <?php include("includes/assets/sidebar.php"); ?>

        <!-- Products section on the search page -->
        <?php
        /* Getting the get request and showing the products list. */
        if (isset($_GET['q'])) {
            $search = escape($_GET['q']); # Search of the user
            // Storing the search history in Cookies.
            $sunid = uniqid(); // Uniqueid of a search history.
            $_SESSION["search_{$sunid}"] = $search;

            // Displaying random products if random is searched.
            if ($_GET['q'] == "random" ) {
                $query = "SELECT * FROM products ORDER BY RAND() ";
            }
            // Query for the products' list searched by the user.
            else {
                $query = "SELECT * FROM products WHERE product_tags LIKE '%{$search}%' OR product_name LIKE '%{$search}%' OR product_code LIKE '%{$search}%' ORDER BY product_id DESC ";
            }
        }
        else {
            header("Location: index.php");
        }
        // Querying the products list.
        $result = query($query);

        if (mysqli_num_rows($result) == 0) {
            // Displaying banner if no results found.
            echo <<<DELIMETER
            <section class="cart-empty-warning">
                <h1>No Results Found!</h1>
                <img src="img/empty_cart.webp" width="100px" alt="">
            </section>
            DELIMETER;
        } else {
            // Opening the tag of products section.
            echo <<<DELIMETER
            <section class="products_section">
            DELIMETER;

            // Displaying all the products.
            while ($row = mysqli_fetch_array($result)) {
                get_product_details($row);
        ?>
            <main class="product_<?php echo $product_code; ?>">
                <?php
                // Displaying the heart button if the user is logged in.
                if (isset($_SESSION['user_code'])) {
                    // Displaying a red heart if the product is in the wishlist of the user.
                    if (isin_wishlist($product_code)) {
                        echo <<<DELIMETER
                        <div class="heart">
                            <i class="fas fa-heart"></i>
                        </div>
                        DELIMETER;
                    }
                    // Displaying a black heart if the product is in the wishlist of the user.
                    else {
                        echo <<<DELIMETER
                        <div class="heart">
                            <i class="far fa-heart"></i>
                        </div>
                        DELIMETER;
                    }
                }
                ?>
                <div class="product-img <?php echo $product_code; ?>">
                    <img src="<?php echo $product_img; ?>" alt="<?php echo $product_name; ?>">
                </div>
                <div class="product-details <?php echo $product_code; ?>">
                    <div class="product-name">
                        <h4><?php echo $product_name; ?></h4>
                    </div>
                    <div class="product-price">
                        <h3><strong><i class="fas fa-rupee-sign"></i><?php echo $product_price; ?></strong> <small><del><i class="fas fa-rupee-sign"></i><?php echo $product_mrp; ?></del></small> <small><?php echo round((($product_mrp - $product_price)/$product_mrp)*100, 0); ?>% off</small></h3>
                    </div>
                    <div class="product-tag">
                        <h3><i class="fas fa-tags"></i> You save ₹<?php echo $product_mrp - $product_price; ?></h3>
                    </div>
                    <div class="product-rate">
                        <h3><?php echo $product_ratings; ?> <i class="fas fa-star"></i></h3>
                    </div>
                    <div class="product-stats">
                        <strong>Free Delivery <i class="fas fa-truck"></i></strong>
                    </div>
                </div>
            </main>
            <?php }} ?>
        </section>

        <!-- Footer of the Page -->
        <?php include "includes/assets/html-footer.php"; ?>
    </section>
</body>
<script>
    document.body.innerHTML += '<a href="#nav-header" class="to-top"><i class="fas fa-chevron-up"></i></a>';
    toTop = document.getElementsByClassName("to-top")[0];
    toTop.style.display = "block";

    toTop.onclick = () => {
        document.documentElement.scrollTop = 0;
        document.body.scrollTop = 0;
    }
</script>
<script src="js/script.js"></script>
<script src="js/search.js"></script>
</html>