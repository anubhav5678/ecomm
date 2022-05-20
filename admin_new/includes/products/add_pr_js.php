<!-- Including the configration files. -->
<?php include "../../../includes/config/db.php"; ?>
<?php include "../../../includes/config/functions.php"; ?>
<?php include "../assets/functions.php"; ?>

<?php
/* Code when the products' JSON file is uploaded. */
if (isset($_POST['upload'])) {
    $p_count = 0; # The number of products inserted into the database.
    $ps_cat = escape($_POST['pros_cat']); # Getting the category of products.
    $ps_profit = (int) escape($_POST['pros_profit']); # Getting the profit of products.
    $ps_mrp_margin = (int) escape($_POST['pros_mrp_margin']); # Getting the margin on mrp of products.
    $ps_tags = escape($_POST['pros_tags']); # Getting the tags of products.
    $json_file_tmp = $_FILES['json']['tmp_name']; # Getting the temporary name of products' file.

    move_uploaded_file($json_file_tmp, "files/products.json"); # Moving the uploaded file to a known path.

    // Opening the products' JSON file.
    $pros_json = fopen("files/products.json", "r") or die("Unable to open the file.");
    // Getting the JSON from the file and decoding it to a PHP object.
    $json = json_decode(fread($pros_json, filesize("files/products.json")));
    // Closing the JSON file.
    fclose($pros_json);

    // Iterating through the JSON for getting each product's data.
    foreach ($json as $key => $value) {
        $code = explode("/", $value->img); # Exploding image instance for required data.
        $code = $code[5]; # Getting the code of the product.
        $name = replace_char($value->name); # Getting the name of the product.
        $sprice = (int) $value->supply_price; # Getting the supplier's price of the product.
        $price = $sprice + $ps_profit; # Setting the price of a product.
        $mrp = $sprice + (int) (($ps_mrp_margin/100) * $price); # Setting the mrp of a product.
        $ratings = $value->ratings == "N/A" ? 0 : $value->ratings; # Checking the product's rtaings and inserting a right value.
        
        /* Getting the details and size of a product. */
        // Replacing the unused characters from detaileach detail of the product - "\u00a0", ",", "'", "(", ")".
        $details = replace_char($value->detail); # The details array of a product.
        $fordet = ""; # Container for the formatted details of a product.
        $sizes = $value->size; # The sizes array of a product.
        $forsize = ""; # Container for the formatted sizes of a product.

        // Iterating through details array and appending each detail into the formatted details container.
        for ($i=0; $i < count($details); $i++) { 
            $fordet .= $details[$i] . ",";
        }

        // Iterating through sizes array and appending each size into the formatted sizes container.
        if (!$sizes) { # Adding into sizes if the size instance is not empty.
            $forsize = "no-size";
        } else {
            for ($i=0; $i < count($sizes); $i++) {
                $forsize .= $sizes[$i] . ",";
            }
        }

        /* Inserting the products. */
        if (!is_in_products($code)) {
            /* Inserting the data of the products into the database - table products. */
            $query = "INSERT INTO `products`(`product_code`, `product_name`, `product_img`, `product_price`, `product_mrp`, `product_supply_price`, `product_profit`, `product_link`, `product_details`, `product_tags`, `product_sizes`, `product_ratings`, `product_cat`) ";
            $query .= " VALUES ('{$code}', '{$name}', '{$value->img}', '{$price}', '{$mrp}', '{$sprice}', '{$ps_profit}', '{$value->link}', '{$fordet}', '{$ps_tags}', '{$forsize}', '{$ratings}', '{$ps_cat}')";
            $query = query($query);
            confirmQuery($query);

            $p_count++; # Incrementing the products count on every data insertion.
        } else {
            continue;
        }      
    }
    unlink("files/products.json"); # Deleting the JSON file after inserting the data of products into the database.

    // Displaying the number of products inserted into teh database.
    echo <<<DELIMETER
    <h2>{$p_count} products inserted into the database.</h2>
    DELIMETER;

    redirect("../../index.php");
}
?>