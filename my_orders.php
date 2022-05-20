<?php include("includes/assets/html-header.php"); displayTitle("My Orders"); ?>
<?php if (!isset($_SESSION['user_code'])) redirect("login.php"); ?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Orders page content -->
    <section class="page-content">
        <!-- The navbar -->
        <?php include("includes/assets/navbar-sl.php"); nav("My Orders"); ?>

        <!-- Order categories -->
        <main class="order-header">
            <a href="my_orders.php?a=all">All</a>
            <a href="my_orders.php?a=del">Delivered</a>
            <a href="my_orders.php?a=ret">Returned</a>
            <a href="my_orders.php?a=can">Cancelled</a>
        </main>
        <section class="order-confirm">
            <main class="order-popup">
                <h3></h3>
                <div class="btns">
                    <button id="cancel">Cancel</button>
                    <button id="ok">OK</button>
                </div>
            </main>
        </section>
        <!-- Orders -->
        <?php
        $l = ""; // Setting the variable for the number of link selected.
        // Code for displaying the orders.
        if (isset($_GET['a'])) {
            // Getting the Request and displaying the orders.
            switch ($_GET['a']) {
                case 'del': // Displaying the delivered orders of a user.
                    include("includes/orders/delivered_orders.php");
                    $l = 1;
                    break;

                case 'ret': // Displaying the returned orders of a user.
                    include("includes/orders/returned_orders.php");
                    $l = 2;
                    break;

                case 'can': // Displaying the cancelled orders of a user.
                    include("includes/orders/cancelled_orders.php");
                    $l = 3;
                    break;

                case 'retpro': // Opening the return a product page.
                    $l = 0;
                    include("includes/orders/return_product.php");
                    break;

                default: // Displaying all the orders of a  by default.
                    include("includes/orders/all_orders.php");
                    $l = 0;
                    break;
            }
        } else {
            // Showing all the orders by default.
            $l = 0;
            include("includes/orders/all_orders.php");
        }
        ?>
    </section>
</body>
<script>
    const l = <?php echo isset($l) ? $l : ""; ?>;
</script>
<script src="js/orders.js"></script>
</html>