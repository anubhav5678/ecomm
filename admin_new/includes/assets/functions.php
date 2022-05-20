<?php
/* All the functions for Admin pages */
// Function for displaying the name of the admin.
function admin_name()
{
    return isset($_SESSION['username']) ? $_SESSION['username'] : "";
}

// Function for checking that a user is admin.
function is_admin($u)
{
    $query = query("SELECT id FROM admins WHERE user_code = '{$u}' ");
    confirmQuery($query);

    // Checking the number of rows queried.
    if (mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}
// Function for checking that a product is available in the database or not.
function is_in_products($c)
{
    $query = query("SELECT product_code FROM products WHERE product_code = '{$c}'");
    confirmQuery($query);

    // Checking the number of rows queried.
    if (mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}

// Function for replacing some characters with HTML escape character.
function replace_char($var)
{
    $var = str_replace("\u00a0", " ", $var);
    $var = str_replace(",", "&#44;", $var);
    $var = str_replace("'", "&quot;", $var);
    $var = str_replace("(", "&#40;", $var);
    $var = str_replace(")", "&#41;", $var);

    return $var;
}

// Function for getting the total number of orders.
function get_orders()
{
    $query = query("SELECT COUNT(order_id) FROM orders ");
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of delivered orders.
function get_del_orders()
{
    $query = query("SELECT COUNT(order_id) FROM orders WHERE order_user_status = 'delivered' AND order_action = 'delivered' ");
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of returned orders.
function get_ret_orders()
{
    $query = query("SELECT COUNT(order_id) FROM orders WHERE order_user_status = 'returned' AND order_action = 'returned' ");
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of cancelled orders.
function get_can_orders()
{
    $query = query("SELECT COUNT(order_id) FROM orders WHERE order_user_status = 'cancelled' AND order_action = 'cancelled' ");
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total profit from the orders.
function get_revenue()
{
    $query = "SELECT SUM(product_price) AS tot_pr, ";
    $query .= "SUM(product_supply_price) AS tot_sup_pr ";
    $query .= "FROM orders INNER JOIN products ON ";
    $query .= "orders.product_code = products.product_code ";
    $query .= "WHERE order_user_status = 'delivered' ";
    $query .= "AND order_action = 'delivered' ";
    $query = query($query);
    confirmQuery($query);

    $row = mysqli_fetch_array($query);
    $tt_pr = $row['tot_pr'];
    $tt_spr = $row['tot_sup_pr'];

    return ($tt_pr - $tt_spr);
}

// Function for getting the total sales from the orders.
function get_sales()
{
    $query = "SELECT SUM(product_price) AS tot_pr ";
    $query .= "FROM orders INNER JOIN products ON ";
    $query .= "orders.product_code = products.product_code ";
    $query .= "WHERE order_user_status = 'delivered' ";
    $query .= "AND order_action = 'delivered' ";
    $query = query($query);
    confirmQuery($query);

    $row = mysqli_fetch_array($query);

    return $row['tot_pr'];
}

// Function for getting the total sales of the current month from the orders.
function get_sls_mon()
{
    $query = "SELECT SUM(product_price) AS tot_pr ";
    $query .= "FROM orders INNER JOIN products ON ";
    $query .= "orders.product_code = products.product_code ";
    $query .= "WHERE order_user_status = 'delivered' ";
    $query .= "AND order_action = 'delivered' AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    $row = mysqli_fetch_array($query);

    return $row['tot_pr'];
}

// Function for getting the total profit of the current month from the orders.
function get_rev_mon()
{
    $query = "SELECT SUM(product_price) AS tot_pr, ";
    $query .= "SUM(product_supply_price) AS tot_sup_pr ";
    $query .= "FROM orders INNER JOIN products ON ";
    $query .= "orders.product_code = products.product_code ";
    $query .= "WHERE order_user_status = 'delivered' ";
    $query .= "AND order_action = 'delivered' AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    $row = mysqli_fetch_array($query);
    $tt_pr = $row['tot_pr'];
    $tt_spr = $row['tot_sup_pr'];

    return ($tt_pr - $tt_spr);
}

// Function for getting the total number of orders of the current month.
function get_ods_mon()
{
    $query = "SELECT COUNT(order_id) FROM orders WHERE ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of delivered orders of the current month.
function get_del_mon()
{
    $query = "SELECT COUNT(order_id) FROM orders WHERE ";
    $query .= "order_user_status = 'delivered' AND order_action = 'delivered' AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of returned orders of the current month.
function get_ret_mon()
{
    $query = "SELECT COUNT(order_id) FROM orders WHERE ";
    $query .= "order_user_status = 'returned' AND order_action = 'returned' AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of cancelled orders of the current month.
function get_can_mon()
{
    $query = "SELECT COUNT(order_id) FROM orders WHERE ";
    $query .= "order_user_status = 'cancelled' AND order_action = 'cancelled' AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of orders today.
function get_ods_tod()
{
    $query = "SELECT COUNT(order_id) FROM orders WHERE ";
    $query .= "DATE(orders.order_date) = CURDATE() AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of delivered orders today.
function get_del_tod()
{
    $query = "SELECT COUNT(order_id) FROM orders WHERE ";
    $query .= "order_user_status = 'delivered' AND order_action = 'delivered' AND ";
    $query .= "DATE(orders.order_date) = CURDATE() AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of returned orders today.
function get_ret_tod()
{
    $query = "SELECT COUNT(order_id) FROM orders WHERE ";
    $query .= "order_user_status = 'returned' AND order_action = 'returned' AND ";
    $query .= "DATE(orders.order_date) = CURDATE() AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of cancelled orders today.
function get_can_tod()
{
    $query = "SELECT COUNT(order_id) FROM orders WHERE ";
    $query .= "order_user_status = 'cancelled' AND order_action = 'cancelled' AND ";
    $query .= "DATE(orders.order_date) = CURDATE() AND ";
    $query .= "MONTH(orders.order_date) = MONTH(NOW()) AND ";
    $query .= "YEAR(orders.order_date) = YEAR(NOW()) ";
    $query = query($query);
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the total number of products int eh database.
function get_tot_num($tab)
{
    $query = query("SELECT COUNT(*) FROM {$tab} ");
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}

// Function for getting the number of products in the specified category.
function get_pros_incat($cat)
{
    $query = query("SELECT COUNT(*) FROM products WHERE product_cat = '{$cat}' ");
    confirmQuery($query);

    return mysqli_fetch_array($query)[0];
}
?>