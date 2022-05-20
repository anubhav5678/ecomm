<!-- Including the configration files. -->
<?php include "../../../includes/config/db.php"; ?>
<?php include "../../../includes/config/functions.php"; ?>
<?php include "../assets/functions.php"; ?>

<?php
if (isset($_POST['a'])) {
    switch (escape($_POST['a'])) {
        case 'bulk_chn_cats':
            $bcis = $_POST['bcis'];
            $ncat = escape($_POST['new_cat']);
            for ($i=0; $i < count($bcis); $i++) {
                $v = escape($bcis[$i]);
                $query = query("UPDATE products SET product_cat = '{$ncat}' WHERE product_id = '{$v}' ");
                confirmQuery($query);
            }
            break;
        case 'bulk_decre_pros':
            $bcis = $_POST['bcis'];
            $amt = escape($_POST['decre_amt']);
            for ($i=0; $i < count($bcis); $i++) {
                $v = escape($bcis[$i]);
                $query = query("UPDATE products SET product_price = product_price - {$amt} WHERE product_id = '{$v}' ");
                confirmQuery($query);
            }
            break;
        case 'bulk_incre_pros':
            $bcis = $_POST['bcis'];
            $amt = escape($_POST['incre_amt']);
            for ($i=0; $i < count($bcis); $i++) {
                $v = escape($bcis[$i]);
                $query = query("UPDATE products SET product_price = product_price + {$amt} WHERE product_id = '{$v}' ");
                confirmQuery($query);
            }
            break;
        case 'bulk_del_pros':
            $bcis = $_POST['bcis'];
            for ($i=0; $i < count($bcis); $i++) {
                $v = escape($bcis[$i]);
                $query = query("DELETE FROM products WHERE product_id = '{$v}' ");
                confirmQuery($query);
            }
            break;
        case 'del_pro':
            $bcis = escape($_POST['bcis']);
            $query = query("DELETE FROM products WHERE product_id = {$bcis} ");
            confirmQuery($query);
            break;
        case 'edit_pro':
            $edid = escape($_POST['edit_id']);
            $pr_data = $_POST['pro_data'];

            $p_code = escape($pr_data[0]);
            $p_name = escape($pr_data[1]);
            $p_img = escape($pr_data[2]);
            $p_price = (int) escape($pr_data[3]);
            $p_mrp = (int) escape($pr_data[4]);
            $p_sprice = (int) escape($pr_data[5]);
            $p_profit = (int) ($p_price - $p_sprice);
            $p_link = escape($pr_data[6]);
            $p_details = escape($pr_data[7]);
            $p_tags = escape($pr_data[8]);
            $p_sizes = escape($pr_data[9]);
            $p_ratings = escape($pr_data[10]);
            $p_cat = escape($pr_data[11]);

            // Query for updating data into the database.
            $query = "UPDATE products SET product_code = '{$p_code}', ";
            $query .= "product_name = '{$p_name}', ";
            $query .= "product_img = '{$p_img}', ";
            $query .= "product_price = '{$p_price}', ";
            $query .= "product_mrp = '{$p_mrp}', ";
            $query .= "product_supply_price = '{$p_sprice}', ";
            $query .= "product_profit = '{$p_profit}', ";
            $query .= "product_link = '{$p_link}', ";
            $query .= "product_details = '{$p_details}', ";
            $query .= "product_tags = '{$p_tags}', ";
            $query .= "product_sizes = '{$p_sizes}', ";
            $query .= "product_ratings = '{$p_ratings}', ";
            $query .= "product_cat = '{$p_cat}' ";
            $query .= "WHERE product_id = '{$edid}' ";

            $query = query($query);
            confirmQuery($query);
            break;
        case 'add_pro':
            $pr_data = $_POST['pro_data'];

            $p_code = escape($pr_data[0]);
            $p_name = escape($pr_data[1]);
            $p_img = escape($pr_data[2]);
            $p_price = (int) escape($pr_data[3]);
            $p_mrp = (int) escape($pr_data[4]);
            $p_sprice = (int) escape($pr_data[5]);
            $p_profit = (int) ($p_price - $p_sprice);
            $p_link = escape($pr_data[6]);
            $p_details = escape($pr_data[7]);
            $p_tags = escape($pr_data[8]);
            $p_sizes = escape($pr_data[9]);
            $p_ratings = escape($pr_data[10]);
            $p_category = escape($pr_data[11]);

            // Query for inserting data into the database.
            if (!is_in_products($p_code)) {
                $query = "INSERT INTO `products`(`product_code`, `product_name`, `product_img`, `product_price`, `product_mrp`, `product_supply_price`, `product_profit`, `product_link`, `product_details`, `product_tags`, `product_sizes`, `product_ratings`, `product_cat`) ";
                $query .= " VALUES ('{$p_code}', '{$p_name}', '{$p_img}', '{$p_price}', '{$p_mrp}', '{$p_sprice}', '{$p_profit}', '{$p_link}', '{$p_details}', '{$p_tags}', '{$p_sizes}', '{$p_ratings}', '{$p_category}')";
                $query = query($query);
                confirmQuery($query);
            }
            break;
    }
}
?>