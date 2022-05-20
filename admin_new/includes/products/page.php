<!-- Including the configration files. -->
<?php include "../../../includes/config/db.php"; ?>
<?php include "../../../includes/config/functions.php"; ?>

<?php
if (isset($_POST['a'])) {
    switch (escape($_POST['a'])) {
        case 'ajs':
            // Adding the header and table head.
            $cont = <<<DELIMETER
            <main class="form flex column jc-center bg-white">
                <h3 class="col-black container-head">Add Products With JSON File</h3>
                <form class="flex column jc-center" action="includes/products/add_pr_js.php" method="POST" enctype="multipart/form-data">
            DELIMETER;

            // Adding the select tag in the content for categories.
            $cont .= <<<DELIMETER
            <div class="form-group flex column ">
                <label for="category">Products' Category</label>
                <select name="pros_cat">
                    <option value="">Select the Products' Category</option>
            DELIMETER;

            // Getting all the categories for the form to add products.
            $query = query("SELECT * FROM categories ");
            confirmQuery($query);

            while ($row = mysqli_fetch_assoc($query)) {
                $cont .= <<<DELIMETER
                <option value="{$row['cat_name']}">{$row['cat_name']}</option>
                DELIMETER;
            }

            // Adding all other input fields closing the tag.
            $cont .= <<<DELIMETER
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profit">Products' Price Increment (Profit)</label>
                        <input type="number" name="pros_profit" id="profit">
                    </div>
                    <div class="form-group">
                        <label for="mrp">Products' MRP Surplus (%)</label>
                        <input type="number" name="pros_mrp_margin" id="mrp">
                    </div>
                    <div class="form-group">
                        <label for="tags">Products' Tags</label>
                        <input type="text" name="pros_tags" id="tags">
                    </div>
                    <div class="form-group">
                        <label for="file">JSON File</label>
                        <input type="file" name="json" value="">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="upload" value="Upload">
                    </div>
                </form>
            </main>
            DELIMETER;

            echo $cont;
            break;

        case 'edit_pro':
            $pr_id = escape($_POST['adt_info']);
            $cont = <<<DELIMETER
            <main class="form flex column jc-center bg-white">
                <h3 class="col-black container-head">Products</h3>
            DELIMETER;

            $query = query("SELECT * FROM products WHERE product_id = '{$pr_id}' ");

            $pr_row = mysqli_fetch_array($query);

            $cont .= <<<DELIMETER
            <div>
                <div class="form-group">
                    <label for="pc">Product Code</label>
                    <input type="text" name="p_0" id="pc" value="{$pr_row['product_code']}">
                </div>
                <div class="form-group">
                    <label for="pn">Product Name</label>
                    <input type="text" name="p_1" id="pn" value="{$pr_row['product_name']}">
                </div>
                <div class="form-group">
                    <label for="pi">Product Image</label>
                    <input type="text" name="p_2" id="pi" value="{$pr_row['product_img']}">
                </div>
                <div class="form-group">
                    <label for="pp">Product Price</label>
                    <input type="number" name="p_3" id="pp" value="{$pr_row['product_price']}">
                </div>
                <div class="form-group">
                    <label for="pmrp">Product MRP</label>
                    <input type="number" name="p_4" id="pmrp" value="{$pr_row['product_mrp']}">
                </div>
                <div class="form-group">
                    <label for="psp">Product Supply Price</label>
                    <input type="number" name="p_5" id="psp" value="{$pr_row['product_supply_price']}">
                </div>
                <div class="form-group">
                    <label for="pl">Product Link</label>
                    <input type="text" name="p_6" id="pl" value="{$pr_row['product_link']}">
                </div>
                <div class="form-group flex column">
                    <label for="pd">Product Details</label>
                    <textarea rows="20" cols="20" name="p_7" id="pd">{$pr_row['product_details']}</textarea>
                </div>
                <div class="form-group">
                    <label for="pt">Product Tags</label>
                    <input type="text" name="p_8" id="pt" value="{$pr_row['product_tags']}">
                </div>
                <div class="form-group">
                    <label for="ps">Product Sizes</label>
                    <input type="text" name="p_9" id="ps" value="{$pr_row['product_sizes']}">
                </div>
                <div class="form-group">
                    <label for="pr">Product Ratings</label>
                    <input type="number" name="p_10" id="pr" value="{$pr_row['product_ratings']}">
                </div>
            DELIMETER;

            $cont .= <<<DELIMETER
            <div class="form-group">
                <label for="pc">Product Category</label>
                <div class="input">
                    <select name="p_11" id="pc">
                        <option value="">Select the Product's Category</option>
            DELIMETER;

            $query = query("SELECT * FROM categories ");
            confirmQuery($query);

            while ($row = mysqli_fetch_assoc($query)) {
                if ($row['cat_name'] == $pr_row['product_cat']) {
                    $cont .= <<<DELIMETER
                    <option value="{$row['cat_name']}" selected>{$row['cat_name']}</option>
                    DELIMETER;
                } else {
                    $cont .= <<<DELIMETER
                    <option value="{$row['cat_name']}">{$row['cat_name']}</option>
                    DELIMETER;
                }
            }

            $cont .= <<<DELIMETER
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="edit_product" value="Save">
                    </div>
                </div>
            </main>
            DELIMETER;

            echo $cont;
            break;

        case 'add':
            $cont = <<<DELIMETER
            <main class="form flex column jc-center bg-white">
                <h3 class="col-black container-head">Products</h3>
                <div>
                    <div class="form-group">
                        <label for="pc">Product Code</label>
                        <input type="text" name="p_0" id="pc">
                    </div>
                    <div class="form-group">
                        <label for="pn">Product Name</label>
                        <input type="text" name="p_1" id="pn">
                    </div>
                    <div class="form-group">
                        <label for="pi">Product Image</label>
                        <input type="text" name="p_2" id="pi">
                    </div>
                    <div class="form-group">
                        <label for="pp">Product Price</label>
                        <input type="number" name="p_3" id="pp">
                    </div>
                    <div class="form-group">
                        <label for="pmrp">Product MRP</label>
                        <input type="number" name="p_4" id="pmrp">
                    </div>
                    <div class="form-group">
                        <label for="psp">Product Supply Price</label>
                        <input type="number" name="p_5" id="psp">
                    </div>
                    <div class="form-group">
                        <label for="pl">Product Link</label>
                        <input type="text" name="p_6" id="pl">
                    </div>
                    <div class="form-group flex column">
                        <label for="pd">Product Details</label>
                        <textarea rows="20" cols="20" name="p_7" id="pd"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pt">Product Tags</label>
                        <input type="text" name="p_8" id="pt">
                    </div>
                    <div class="form-group">
                        <label for="ps">Product Sizes</label>
                        <input type="text" name="p_9" id="ps">
                    </div>
                    <div class="form-group">
                        <label for="pr">Product Ratings</label>
                        <input type="number" name="p_10" id="pr">
                    </div>
            DELIMETER;

            $cont .= <<<DELIMETER
            <div class="form-group">
                <label for="pc">Product Category</label>
                <div class="input">
                    <select name="p_11" id="pc">
                        <option value="">Select the Product's Category</option>
            DELIMETER;

            $query = query("SELECT * FROM categories ");
            confirmQuery($query);

            while ($row = mysqli_fetch_assoc($query)) {
                $cont .= <<<DELIMETER
                <option value="{$row['cat_name']}">{$row['cat_name']}</option>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="add_product" value="Add Product">
                    </div>
                </div>
            </main>
            DELIMETER;

            echo $cont;
            break;

        default:
            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="col-black container-head">Products</h3>
                <table class="table table-bordered table-hover">
            DELIMETER;
            // Code for displaying message if no products are there in database.
            $query = query("SELECT * FROM products ORDER BY product_id DESC");

            if (mysqli_num_rows($query) > 0) {
                $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>MRP</th>
                        <th>Supply Price</th>
                        <th>Profit</th>
                        <th>Details</th>
                        <th>Tags</th>
                        <th>Sizes</th>
                        <th>Ratings</th>
                        <th>Availability</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Added On</th>
                        <th>Supplier Name</th>
                        <th colspan="3" style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;

                // Displaying all the products.
                while ($row = mysqli_fetch_assoc($query)) {
                    $pr_pro = ($row['product_price'] - $row['product_supply_price']);
                    $cont .= <<<DELIMETER
                    <tr class="all-col-black pro_{$row['product_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['product_id']}"></th>
                        <th>{$row['product_id']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th><a href="../product.php?c={$row['product_code']}" style="background-color: #fff"><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></a></th>
                        <th>₹{$row['product_price']}</th>
                        <th>₹{$row['product_mrp']}</th>
                        <th>₹{$row['product_supply_price']}</th>
                        <th>₹{$pr_pro}</th>
                        <th><textarea rows="3" cols="60" disabled>{$row['product_details']}</textarea></th>
                        <th>{$row['product_tags']}</th>
                        <th>{$row['product_sizes']}</th>
                        <th>{$row['product_ratings']}</th>
                        <th>{$row['product_availability']}</th>
                        <th>{$row['product_cat']}</th>
                        <th>{$row['product_sub_cat']}</th>
                        <th>{$row['product_added_date']}</th>
                        <th>{$row['product_supplier']}</th>
                        <th><button class="edit-btn">Edit</button></a></th>
                        <th><button class="del-btn">Delete</button></th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There are no products in the database!</h1>
                DELIMETER;        
            }
            
            $cont .= <<<DELIMETER
            </tbody><!-- Ending the table. -->
                </table>
                <div class="bg-black table-bottom flex row ai-center">
                    <select name="bulk_option">
                        <option value="">Select an option...</option>
                        <option value="del-pros">Delete</option>
                        <option value="chg-cat-pros">Change category</option>
                        <option value="incre-prc-pros">Increase price</option>
                        <option value="decre-prc-pros">Decrease price</option>
                    </select>
                    <select class="chg-pros-cat">
                        <option value="">Select a category...</option>
            DELIMETER;

            $query = query("SELECT * FROM categories ");
            while ($row = mysqli_fetch_assoc($query)) {
                $cont .= <<<DELIMETER
                <option value="{$row['cat_name']}">{$row['cat_name']}</option>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                        </select>
                    <input type="number" name="price-val" placeholder="Enter the amount">
                    <button id="bulk-action-btn"></button>
                </div>
            </main>
            DELIMETER;

            echo $cont;
            break;
    }
}
?>