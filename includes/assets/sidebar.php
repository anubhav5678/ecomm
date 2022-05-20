<section class="sidebar" id="sidebar">
    <div class="side-nav">
        <a href="index.php"><img src="img/logo.png" width="85px" alt="Logo of page."></a>
        <div id="close-btn" class="close-btn"><i class="fas fa-times"></i></div>
    </div>

    <?php
    // PHP for printing the user if user is logged in.

    if (isset($_SESSION['username'])) {
        $f_name = explode(" ", $_SESSION['username']);
        echo <<<DELIMETER
        <div class='profile no-space'>
            <i class='fas fa-user-circle'></i>
            <p>Hello, {$f_name[0]}</p>
        </div>
        DELIMETER;
    }
    else {
        echo <<<DELIMETER
        <div class='profile space'>
            <i class='fas fa-user-circle'></i>
            <div>
                <a href='login.php'>Login</a> 
                <a href='signup.php'>Sign up</a>
            </div>
        </div>
        DELIMETER;
    }
    ?>
    <div class="details">
        <h5 class="options-head">Profile</h5>
        <ul>
            <li><a href="my_account.php"><i class='fas fa-user-circle'></i> My Account</a></li>
            <li><a href="my_orders.php"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
            <li><a href="my_addressess.php"><i class="fas fa-address-card"></i> My Addressess</a></li>
            <li><a href="cart.php"><svg style="width: 18px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"/></svg> My Cart</a></li>
            <li><a href="wishlist.php"><i class="fas fa-heart" aria-hidden="true"></i> My Wishlist</a></li>
        </ul>
    </div>
    <div class="options">
        <h5 class="options-head">Categories</h5>
        <ul>
            <?php get_categories("sidebar"); // PHP for querying all the categories. ?>
        </ul>
    </div>
    <div class="options s-media">
        <h5 class="options-head">Follow us on</h5>
        <ul>
            <!-- <li><i class="fab fa-facebook-square"></i></li> -->
            <li>
                <a href="https://www.instagram.com/fashioncapital83/"><i class="fab fa-instagram-square"></i></a>
            </li>
            <!-- <li><i class="fab fa-whatsapp-square"></i></li> -->
        </ul>
    </div>
    <div class="options">
        <h5 class="options-head">Query at</h5>
        <ul>
            <li><a href="mailto:fashioncapital2022@gmail.com">fashioncapital2022@gmail.com</a></li>
        </ul>
    </div>
    <?php
    if (isset($_SESSION['username'])) {
        echo "<div class='options'><ul><li><a style='display: flex; justify-content: flex-start; line-height: 15.5px;' href='includes/user/logout.php'><i class='fas fa-sign-out-alt'></i> Logout</a></li></ul></div>";
    }
    ?>
</section>