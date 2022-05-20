<?php
// Function for querying from MySQL.
function query($q)
{
    global $connection;
    return mysqli_query($connection, $q);
}

// Function for redirecting user to a different page.
function redirect($p)
{
    header("Location: {$p}");
}

// Function for confirming a MySQL query.
function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

// Function for getting the number of rows of a query;
function query_num($q)
{
    return mysqli_num_rows($q);
}

// Function for getting the name of a product with its product code.
function getName($c)
{
    $query = query("SELECT product_name FROM products WHERE product_code = '{$c}' ");
    $row = mysqli_fetch_assoc($query);
    return $row['product_name'];
}

// Function for escaping unwanted strings in input.
function escape($str)
{
    global $connection;
    return trim(mysqli_real_escape_string($connection, $str));
}

// Function for not letting an unauthorized user into a restricted page/file.
function restrict_user()
{
    if (!isset($_SESSION['user_code']) || $_SESSION['user_role'] != "admin") {
        redirect("Index.php");
    }
}

// Function for checking that a product is in the wishlist of a user or not.
function isin_wishlist($c)
{
    $query = query("SELECT id FROM wishlist WHERE product_code = '{$c}' AND user_code = '{$_SESSION['user_code']}' ");
    confirmQuery($query);

    // Checking the number of rows.
    if (mysqli_num_rows($query) >= 1) {
        return true;
    }
    else {
        return false;
    }
}

// Function for querying all the categories form the database.
function get_categories($sp = "navbar") {
    global $connection;

    $result = mysqli_query($connection, "SELECT * FROM categories ");
    confirmQuery($result);

    if ($sp === "sidebar") {
        while ($row = mysqli_fetch_array($result)) {
            $cat_id = $row['cat_id'];
            $cat_name = ucfirst($row['cat_name']);

            echo <<<DELIMETER
            <li>
                <a href="category.php?ct={$row['cat_name']}">
                    {$cat_name}<i class="fas fa-chevron-right"></i>
                </a>
            </li>
            DELIMETER;
        }
    }
    else {
        while ($row = mysqli_fetch_array($result)) {
            $cat_id = $row['cat_id'];
            $cat_name = ucfirst($row['cat_name']);
    
            echo <<<DELIMETER
            <li>
                <a href="category.php?ct={$row['cat_name']}">{$cat_name}</a>
            </li>
            DELIMETER;
        }
    }
}

// Function for assigning product details to variables.
function get_product_details($row)
{
    global $product_id, $product_code, $product_full_name, $product_name, $product_img, $product_price, $product_mrp, $product_ratings,  $product_details, $product_sizes;

    $product_id = $row['product_id'];
    $product_code = $row['product_code'];
    $product_full_name = $row['product_name'];
    $product_name = substr($row['product_name'], 0, 20) . "...";
    $product_img = $row['product_img'];
    $product_price = $row['product_price'];
    $product_mrp = $row['product_mrp'];
    $product_ratings = $row['product_ratings'];
    $product_details = $row['product_details'];
    $product_sizes = $row['product_sizes'];
}

// Function for querying products in the cart.
function get_cart_products($row)
{
    global $product_id, $product_code, $product_name, $product_quantity, $product_img, $product_price;
    $product_id = $row['product_id'];
    $product_code = $row['product_code'];
    $product_name = $row['product_name'];
    $product_quantity = $row['product_quantity'];
    $product_img = $row['product_img'];
    $product_price = $row['product_price'];
}

// Function for querying the total amount of products in cart.
function get_products_amount()
{
    global $connection;

    $query = "SELECT SUM(cart.product_price) AS total_price FROM cart INNER JOIN products ON cart.product_code = products.product_code WHERE cart.user_code = '{$_SESSION['user_code']}' ";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $tot = $row['total_price'];
    }
    return $tot;
}

// Function for querying products rows for index page.
function get_product_rows($cat, $tags, $lim = 5)
{
    global $connection;

    $query = "SELECT * FROM products WHERE product_cat = '{$cat}' AND product_tags LIKE '%{$tags}%' LIMIT {$lim} ";
    $result = mysqli_query($connection, $query);

    return $result;
}

// Function for getting the number of products in cart of a user.
function get_cart_num()
{
    $query = query("SELECT cart_id FROM cart WHERE user_code = '{$_SESSION['user_code']}' ");
    confirmQuery($query);
    if (mysqli_num_rows($query) == 0) {
        return 0; 
    }
    else {
        return mysqli_num_rows($query);
    }
}

// Function for getting the the number of products in the wishlist of a user.
function get_wishlist_num()
{
    $query = query("SELECT id FROM wishlist WHERE user_code = '{$_SESSION['user_code']}' ");
    confirmQuery($query);
    if (mysqli_num_rows($query) == 0) {
        return 0; 
    }
    else {
        return mysqli_num_rows($query);
    }
}

// Function for checking that a product is already in the cart of a user.
function is_product_in_cart($uc, $p_code, $p_size)
{
    global $connection;

    $query = query("SELECT * FROM cart WHERE user_code = '{$uc}' AND cart_product_code = '{$p_code}' AND product_size = '{$p_size}' ");

    if (mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}

// Function for checking that an user has registered the address.
function address_registered($uc)
{
    global $connection;

    $query = "SELECT * FROM addressess WHERE user_code = '{$uc}' ";
    $run = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($run) > 0) {
        return true;
    } else {
        return false;
    }
}

// Function for querying various set of items on index page.
function get_product_rows_on_index($cat, $name, $lim = '5')
{
    $query = query("SELECT * FROM products WHERE product_cat LIKE '%" . $cat . "%' AND product_name LIKE '%" . $name . "%' OR product_tags LIKE '%" . $name. "%' ORDER BY RAND() LIMIT " . $lim . " ");
    confirmQuery($query);

    if (!mysqli_num_rows($query)) {
        echo "No prodcts";
    } else {
        while ($row = mysqli_fetch_assoc($query)) {
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
    }
}
?>