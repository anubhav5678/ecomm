<header id="nav-header">
    <nav class="navbar">
        <div class="ham"><i class="fas fa-bars" id="ham-btn"></i></div>
        <a href="index.php" class="logo">
            <?php include("includes/assets/logo.php"); logo(""); ?>
        </a>
        <!-- Searchbar for searching products across website -->
        <form action="search.php" class="search input" id="search" method="GET">
            <img src="img/search_icon.png" width="27px" alt="">
            <input type="search" name="q" id="searchbar" placeholder="Search for products" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ""; ?>" autocomplete="off">
            <i class="fas fa-times" id="search-clear"></i>
        </form>
        <div class="options">
            <?php if (isset($_SESSION['username'])) : ?>
                <ul>
                    <li><a href='#' id='account'><i class='fas fa-user-circle'></i></a></li>
                    <li><a href='wishlist.php'><i class='fas fa-heart'></i></a></li>
                    <li><a href='cart.php'><svg style="width: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"/></svg></a><sup id="cart-num"></sup></li>
                </ul>
            <?php else : ?>
                <ul class='log'>
                    <li><a href='login.php'>Login</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>
    <div class="desk-account" id="desk-account">
        <ul>
            <li><a href="my_account.php"><i class='fas fa-user-circle'></i> My Account</a></li>
            <li><a href="my_orders.php"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
            <li><a href="my_addressess.php"><i class="fas fa-address-card"></i> My Addressess</a></li>
            <li><a href="includes/user/logout.php"><i class='fas fa-sign-out-alt'></i> Logout</a></li>
        </ul>
    </div>
    <main class="suggest">
        
    </main>
    <!-- Categories section for PC below navbar. -->
    <div class="categories" id="categories">
        <ul>
            <?php get_categories(); // PHP for querying all the categories. ?>
        </ul>
    </div>
    <div class="sub-categories" id="sub-cat">
    </div>
</header>