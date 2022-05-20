<?php include("includes/assets/html-header.php"); displayTitle("Thank You For Shopping With Us"); ?>
<?php
/* Code for preventing the user from getting to
the thank you page without ordering a product. */
if (!isset($_SESSION['referer']) || $_SESSION['referer'] != "ordered") {
    redirect("index.php");
} else {
    unset($_SESSION['referer']);
}
?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Thank you page container -->
    <section class="page-content">
        <!-- Navbar of the website -->
        <?php include("includes/assets/navbar.php"); ?>

        <!-- Sidebar for mobiles and tablets. It's invoked when hamburger button is clicked. -->
        <?php include("includes/assets/sidebar.php"); ?>

        <section class="thanks">
            <main class="mess">
                <h2>Thank you for shopping with us!</h2>
                <h4>Your order has been placed successfully.</h4>
                <img src="img/check.png" width="100px" alt="Ordered Succesfully!">
                <a class="a-link" href="index.php">Continue Shopping</a>
            </main>
            <!-- <h3>Some more products</h3>
            <main class="products"> -->
                <?php
                // $query = query("SELECT * FROM products ORDER BY RAND() LIMIT 10");
                // confirmQuery($query);

                // while ($row = mysqli_fetch_assoc($query)) {
                //     $product_discount = ceil((($row['product_mrp'] - $row['product_price']) / $row['product_mrp']) * 100);

                //     $product = <<<DELIMETER
                //     <a href="product.php?c={$row['product_code']}" title="{$row['product_name']} at ₹{$row['product_price']}" class="product">
                //         <div class="img">
                //             <img src="{$row['product_img']}" alt="{$row['product_name']}">
                //         </div>
                //         <div class="tags">
                //             <h5>{$row['product_name']}</h5>
                //             <h5>₹{$row['product_price']} <del>₹{$row['product_mrp']}</del> <span class="discount">{$product_discount}% off</span></h5>
                //         </div>
                //     </a>
                //     DELIMETER;

                //     echo $product;
                // }
                ?>
            <!-- </main> -->
        </section>
    </section>
</body>
<script src="js/script.js"></script>
</html>