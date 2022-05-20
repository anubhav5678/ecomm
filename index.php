<?php include "includes/assets/html-header.php"; displayTitle(); ?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Index page content -->
    <section class="page-content">
        <!-- Navbar of the website -->
        <?php include "includes/assets/navbar.php"; ?>
        
        <!-- Sidebar for mobiles and tablets. It's invoked when hamburger button is clicked. -->
        <?php include "includes/assets/sidebar.php"; ?>
        
        <!-- Index page's container for products -->
        <a href="thankyou.php"></a>
        <div class="index-container">
            <!-- Deals of the day section -->
            <div class="product-column-2"> <!-- Product column with 4 - 5 products. -->
                <h3><strong>Trending</strong><a href="search.php?q=random">View All <i class='fas fa-chevron-right'></i></a></h3>
                <div class="products">
                    <?php
                    $query = query("SELECT * FROM products ORDER BY RAND() LIMIT 5");
                    confirmQuery($query);

                    while ($row = mysqli_fetch_array($query)) {
                        $product_name = substr($row['product_name'], 0, 20) . "...";
                        $product_discount = ceil((($row['product_mrp'] - $row['product_price']) / $row['product_mrp']) * 100);

                        $product = <<<DELIMETER
                        <a href="product.php?c={$row['product_code']}" title="{$row['product_name']} at ₹{$row['product_price']}" class="product">
                            <div class="img">
                                <img src="{$row['product_img']}" alt="">
                            </div>
                            <div class="tags">
                                <h4>{$product_name}</h4>
                                <h4>₹{$row['product_price']} <del>₹{$row['product_mrp']}</del> <span class="discount">{$product_discount}% off</span></h4>
                            </div>
                        </a>
                        DELIMETER;
                
                        echo $product;
                    } 
                    ?>
                </div>
            </div>

            <div class="product-column-2"> <!-- Product column with 4 - 5 products. -->
                <h3><strong>Recommended For You</strong><a href="search.php?q=random">View All <i class='fas fa-chevron-right'></i></a></h3>
                <div class="products">
                    <?php
                    // Querying products on the basis of users searches - recommendations.
                    if (isset($_SESSION['searches'])) {
                        $query = query("SELECT * FROM products WHERE product_tags LIKE '%{$_COOKIE['Searches']}%' OR product_name LIKE '%{$_COOKIE['Searches']}%' AND product_availability = 'in_stock' ORDER BY RAND() LIMIT 5");
                    } else {
                        $query = query("SELECT * FROM products WHERE product_availability = 'in_stock' ORDER BY RAND() LIMIT 5");
                    }

                    if (mysqli_num_rows($query) == 0) {
                        $query = query("SELECT * FROM products WHERE product_availability = 'in_stock' ORDER BY RAND() LIMIT 5");
                    }
                    while ($row = mysqli_fetch_array($query)) {
                        $product_name = substr($row['product_name'], 0, 20) . "...";
                        $product_discount = ceil((($row['product_mrp'] - $row['product_price']) / $row['product_mrp']) * 100);

                        $product = <<<DELIMETER
                        <a href="product.php?c={$row['product_code']}" title="{$row['product_name']} at ₹{$row['product_price']}" class="product">
                            <div class="img">
                                <img src="{$row['product_img']}" alt="">
                            </div>
                            <div class="tags">
                                <h4>{$product_name}</h4>
                                <h4>₹{$row['product_price']} <del>₹{$row['product_mrp']}</del> <span class="discount">{$product_discount}% off</span></h4>
                            </div>
                        </a>
                        DELIMETER;
                
                        echo $product;
                    }
                    ?>
                </div>
            </div>
                
            <!-- Some other products section  -->
            <div class="product-column-1"> <!-- Product column with 4 - 5 products. -->
                <h3><strong>Men's Shirts</strong> <a href="search.php?q=shirts">View All <i class='fas fa-chevron-right'></i></a></h3>
                <div class="products">
                    <?php get_product_rows_on_index("men", "shirt") ?>
                </div>
            </div>
            
            <!-- Some other products section -->
            <div class="product-column-2"> <!-- Product column with 4 - 5 products. -->
                <h3><strong>Men's Trousers</strong><a href="search.php?q=trousers">View All <i class='fas fa-chevron-right'></i></a></h3>
                <div class="products">
                    <?php get_product_rows_on_index("men", "trouser"); ?>
                </div>
            </div>
            
            <!-- Trending Products section -->
            <div class="products-rows"> <!-- Product row of 10 products. -->
                <h3><strong>Watches for Men</strong> <a href="search.php?q=watches">View All <i class='fas fa-chevron-right'></i></a></h3>
                <div class="products">
                    <?php get_product_rows_on_index("men", "watches"); ?>
                </div>
            </div>

            <!-- Trending Products section -->
            <div class="products-rows"> <!-- Product row of 10 products. -->
                <h3><strong>Men's Shoes</strong> <a href="search.php?q=shoes">View All <i class='fas fa-chevron-right'></i></a></h3>
                <div class="products">
                <?php get_product_rows_on_index("men", "shoes", 10); ?>
                </div>
            </div>

            <!-- Trending Products section -->
            <div class="products-rows"> <!-- Product row of 10 products. -->
                <h3><strong>Sunglassess</strong> <a href="search.php?q=sunglassess">View All <i class='fas fa-chevron-right'></i></a></h3>
                <div class="products">
                <?php get_product_rows_on_index("men", "sunglassess", 10); ?>
                </div>
            </div>
        </div><!-- End of index container. -->

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
</html>