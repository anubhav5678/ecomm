<?php include("includes/assets/html-header.php"); displayTitle("My Account"); ?>
<?php
/* Code for preventing the user from accessing this page without logging in. */
if (!isset($_SESSION['user_code'])) {
    redirect("login.php"); # Redirecting the user to the login page.
}
?>
<body>
    <section class="page-content">
        <!-- The my account navbar -->
        <?php include("includes/assets/navbar-sl.php"); nav("My Account"); ?>
        <?php
        /* Code for getting all the user details from teh database. */
        $query = query("SELECT * FROM users WHERE user_code = '{$_SESSION['user_code']}' ");
        confirmQuery($query);

        while ($row = mysqli_fetch_assoc($query)) {
            $uname = $row['user_full_name'];
            $uphnum = $row['user_phnum'];
            $uemail = $row['user_email'];
        }
        ?>
        <section class="account">
            <main class="acc-data">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c39.77 0 72 32.24 72 72S295.8 272 256 272c-39.76 0-72-32.24-72-72S216.2 128 256 128zM256 448c-52.93 0-100.9-21.53-135.7-56.29C136.5 349.9 176.5 320 224 320h64c47.54 0 87.54 29.88 103.7 71.71C356.9 426.5 308.9 448 256 448z"/></svg>
                <div class="acc-data-child">
                    <input type="text" value="<?php echo $uname; ?>" id="name" readonly>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
                </div>
                <!-- <div class="acc-data-child">
                    <input type="number" name="" value="8227944715" id="ph_num" readonly>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
                </div>
                <div class="acc-data-child">
                    <input type="email" name="" value="anubhavshavaran5678@gmail.com" id="email" readonly>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
                </div> -->
            </main>
            <main class="acc-links">
                <div class="acc-link-child">
                    <h3>My Orders</h3>
                    <a href="my_orders.php">View</a>
                </div>
                <div class="acc-link-child">
                    <h3>My Addressess</h3>
                    <a href="my_addressess.php">View</a>
                </div>
                <div class="acc-link-child">
                    <h3>My Cart</h3>
                    <a href="cart.php">View</a>
                </div>
                <div class="acc-link-child">
                    <h3>My Wishlist</h3>
                    <a href="wishlist.php">View</a>
                </div>
                <div class="acc-link-child">
                    <a href="includes/user/logout.php"><i class='fas fa-sign-out-alt'></i> Logout</a>
                </div>
            </main>
        </section>
    </section>
</body>
<script src="js/script.js"></script>
<script src="js/account.js"></script>
</html>