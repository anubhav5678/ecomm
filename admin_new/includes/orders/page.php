<!-- Including the configration files. -->
<?php include "../../../includes/config/db.php"; ?>
<?php include "../../../includes/config/functions.php"; ?>
<?php include "../assets/functions.php"; ?>

<?php
if (isset($_POST['a'])) {
    switch (escape($_POST['a'])) {
        case 'to_ret':
            $cntr = <<<DELIMETER
            <div class="bg-black table-bottom flex row ai-center">
                <select name="bulk_option">
                    <option value="">Select an option...</option>
                    <option value="ret-orders">Return</option>
                </select>
                <button id="bulk-action-btn"></button>
            </div>
            DELIMETER;

            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="col-black container-head">All Orders To Return</h3>
                <table class="table bg-white">
            DELIMETER;
            
            $query = "SELECT * FROM orders INNER JOIN ";
            $query .= "returns ON orders.order_id = returns.order_id INNER JOIN ";
            $query .= "users ON orders.user_code = users.user_code INNER JOIN ";
            $query .= "products ON orders.product_code = products.product_code ";
            $query .= "WHERE orders.order_user_status = 'returned' AND orders.order_action != 'returned' ORDER BY orders.order_id DESC ";
            $query = query($query);

            if (mysqli_num_rows($query) > 0) {
                // Displaying the head of the table.
                $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>User Account Number</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Size</th>
                        <th>User's Order Status</th>
                        <th>Order Supplier Information</th>
                        <th>Order Date</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;

                // Displaying the returns in the table.
                while ($row = mysqli_fetch_assoc($query)) {
                    $cont .= <<<DELIMETER
                    <tr class="all-col-black ord_{$row['order_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['order_id']}"></th>
                        <th>{$row['order_id']}</th>
                        <th>{$row['user_full_name']}</th>
                        <th>{$row['account_num']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></th>
                        <th>{$row['product_quantity']}</th>
                        <th>{$row['product_size']}</th>
                        <th>{$row['order_user_status']}</th>
                        <th>{$row['order_action']}</th>
                        <th>{$row['order_date']}</th>
                        <th><button class="opr-btn-ret">Return</button></th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There is no order to be returned!</h1>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                    </tbody>
                </table>
                {$cntr}
            </main>
            DELIMETER;

            echo $cont;
            break;

        case 'to_can':
            $cntr = <<<DELIMETER
            <div class="bg-black table-bottom flex row ai-center">
                <select name="bulk_option">
                    <option value="">Select an option...</option>
                    <option value="can-orders">Cancel</option>
                </select>
                <button id="bulk-action-btn"></button>
            </div>
            DELIMETER;

            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="col-black container-head">All Orders To Cancel</h3>
                <table class="table bg-white">
            DELIMETER;
            
            $query = "SELECT * FROM orders INNER JOIN ";
            $query .= "users ON orders.user_code = users.user_code INNER JOIN ";
            $query .= "products ON orders.product_code = products.product_code ";
            $query .= "WHERE orders.order_user_status = 'cancelled' AND orders.order_action != 'cancelled' ORDER BY order_id DESC ";
            $query = query($query);

            if (mysqli_num_rows($query) > 0) {
                // Displaying the head of the table.
                $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Size</th>
                        <th>User's Order Status</th>
                        <th>Order Supplier Information</th>
                        <th>Order Date</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;
        
                // Displaying the returns in the table.
                while ($row = mysqli_fetch_assoc($query)) {
                    $cont .= <<<DELIMETER
                    <tr class="all-col-black ord_{$row['order_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['order_id']}"></th>
                        <th>{$row['order_id']}</th>
                        <th>{$row['user_full_name']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></th>
                        <th>{$row['product_quantity']}</th>
                        <th>{$row['product_size']}</th>
                        <th>{$row['order_user_status']}</th>
                        <th>{$row['order_action']}</th>
                        <th>{$row['order_date']}</th>
                        <th><button class="opr-btn-can">Cancel</button></th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There is no order to be cancelled!</h1>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                    </tbody>
                </table>
                {$cntr}
            </main>
            DELIMETER;

            echo $cont;
            break;

        case 'to_del':
            $cntr = <<<DELIMETER
            <div class="bg-black table-bottom flex row ai-center">
                <select name="bulk_option">
                    <option value="">Select an option...</option>
                    <option value="del-orders">Deliver</option>
                </select>
                <button id="bulk-action-btn"></button>
            </div>
            DELIMETER;

            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="col-black container-head">All Orders To Deliver</h3>
                <table class="table bg-white">
            DELIMETER;
            
            $query = "SELECT * FROM orders INNER JOIN ";
            $query .= "users ON orders.user_code = users.user_code INNER JOIN ";
            $query .= "products ON orders.product_code = products.product_code ";
            $query .= "WHERE orders.order_user_status = 'ordered' AND orders.order_action != 'delivered' ORDER BY order_id DESC ";
            $query = query($query);

            if (mysqli_num_rows($query) > 0) {
                // Displaying the head of the table.
                $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Size</th>
                        <th>User's Order Status</th>
                        <th>Order Supplier Information</th>
                        <th>Order Date</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;
        
                // Displaying the returns in the table.
                while ($row = mysqli_fetch_assoc($query)) {
                    $cont .= <<<DELIMETER
                    <tr class="all-col-black ord_{$row['order_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['order_id']}"></th>
                        <th>{$row['order_id']}</th>
                        <th>{$row['user_full_name']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></th>
                        <th>{$row['product_quantity']}</th>
                        <th>{$row['product_size']}</th>
                        <th>{$row['order_user_status']}</th>
                        <th>{$row['order_action']}</th>
                        <th>{$row['order_date']}</th>
                        <th><button class="opr-btn-del">Deliver</button></th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There is no order to be delivered!</h1>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                    </tbody>
                </table>
                {$cntr}
            </main>
            DELIMETER;

            echo $cont;
            break;

        case 'to_ord':
            $cntr = <<<DELIMETER
            <div class="bg-black table-bottom flex row ai-center">
                <select name="bulk_option">
                    <option value="">Select an option...</option>
                    <option value="ord-orders">Order</option>
                </select>
                <button id="bulk-action-btn"></button>
            </div>
            DELIMETER;

            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="col-black container-head">All Orders To Order</h3>
                <table class="table bg-white">
            DELIMETER;
            
            $query = "SELECT * FROM orders INNER JOIN ";
            $query .= "users ON orders.user_code = users.user_code INNER JOIN ";
            $query .= "products ON orders.product_code = products.product_code ";
            $query .= "INNER JOIN addressess ON orders.user_code = addressess.user_code ";
            $query .= "WHERE orders.order_user_status = 'ordered' AND orders.order_action != 'ordered' ORDER BY order_id DESC ";
            $query = query($query);

            if (mysqli_num_rows($query) > 0) {
                // Displaying the head of the table.
                $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>User Phone Number</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Link</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Size</th>
                        <th>User House no.</th>
                        <th>User Road Name</th>
                        <th>User Landmark</th>
                        <th>User Pincode</th>
                        <th>User City</th>
                        <th>User State</th>
                        <th>User's Order Status</th>
                        <th>Order Supplier Information</th>
                        <th>Order Date</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;
        
                // Displaying the returns in the table.
                while ($row = mysqli_fetch_assoc($query)) {
                    $cont .= <<<DELIMETER
                    <tr class="all-col-black ord_{$row['order_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['order_id']}"></th>
                        <th>{$row['order_id']}</th>
                        <th>{$row['user_full_name']}</th>
                        <th>{$row['user_phnum']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th>{$row['product_price']}</th>
                        <th>{$row['product_link']}</th>
                        <th><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></th>
                        <th>{$row['product_quantity']}</th>
                        <th>{$row['product_size']}</th>
                        <th>{$row['house_num']}</th>
                        <th>{$row['road_name']}</th>
                        <th>{$row['landmark']}</th>
                        <th>{$row['pincode']}</th>
                        <th>{$row['city']}</th>
                        <th>{$row['state']}</th>
                        <th>{$row['order_user_status']}</th>
                        <th>{$row['order_action']}</th>
                        <th>{$row['order_date']}</th>
                        <th><button class="opr-btn-ord">Order</button></th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There is no order to be ordered!</h1>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                    </tbody>
                </table>
                {$cntr}
            </main>
            DELIMETER;

            echo $cont;
            break;

        case 'can':
            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="col-black container-head">All Cancelled Orders</h3>
                <table class="table bg-white">
            DELIMETER;
            
            $query = "SELECT * FROM orders INNER JOIN ";
            $query .= "users ON orders.user_code = users.user_code INNER JOIN ";
            $query .= "products ON orders.product_code = products.product_code ";
            $query .= "WHERE orders.order_user_status = 'cancelled' ORDER BY order_id DESC ";
            $query = query($query);

            if (mysqli_num_rows($query) > 0) {
                // Displaying the head of the table.
                $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Size</th>
                        <th>User's Order Status</th>
                        <th>Order Action</th>
                        <th>Order Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;
        
                // Displaying the returns in the table.
                while ($row = mysqli_fetch_assoc($query)) {
                    $cont .= <<<DELIMETER
                    <tr class="all-col-black ord_{$row['order_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['order_id']}"></th>
                        <th>{$row['order_id']}</th>
                        <th>{$row['user_full_name']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></th>
                        <th>{$row['product_quantity']}</th>
                        <th>{$row['product_size']}</th>
                        <th>{$row['order_user_status']}</th>
                        <th>{$row['order_action']}</th>
                        <th>{$row['order_date']}</th>
                        <th>{$row['order_user_date']}</th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There aren't any cancelled orders!</h1>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                        </tbody>
                </table>
            </main>
            DELIMETER;

            echo $cont;
            break;

        case 'ret':
            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="col-black container-head">All Returned Orders</h3>
                <table class="table bg-white">
            DELIMETER;
            
            $query = "SELECT * FROM orders INNER JOIN ";
            $query .= "users ON orders.user_code = users.user_code INNER JOIN ";
            $query .= "products ON orders.product_code = products.product_code ";
            $query .= "WHERE orders.order_user_status = 'returned' ORDER BY order_id DESC ";
            $query = query($query);

            if (mysqli_num_rows($query) > 0) {
                // Displaying the head of the table.
                $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Size</th>
                        <th>User's Order Status</th>
                        <th>Order Action</th>
                        <th>Order Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;
        
                // Displaying the returns in the table.
                while ($row = mysqli_fetch_assoc($query)) {
                    $cont .= <<<DELIMETER
                    <tr class="all-col-black ord_{$row['order_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['order_id']}"></th>
                        <th>{$row['order_id']}</th>
                        <th>{$row['user_full_name']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></th>
                        <th>{$row['product_quantity']}</th>
                        <th>{$row['product_size']}</th>
                        <th>{$row['order_user_status']}</th>
                        <th>{$row['order_action']}</th>
                        <th>{$row['order_date']}</th>
                        <th>{$row['order_user_date']}</th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There aren't any returned orders!</h1>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                        </tbody>
                    </table>
            </main>
            DELIMETER;

            echo $cont;
            break;

        case 'del':
            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="col-black container-head">All Delivered Orders</h3>
                <table class="table bg-white">
            DELIMETER;
            
            $query = "SELECT * FROM orders INNER JOIN ";
            $query .= "users ON orders.user_code = users.user_code INNER JOIN ";
            $query .= "products ON orders.product_code = products.product_code ";
            $query .= "WHERE orders.order_user_status = 'delivered' ORDER BY order_id DESC ";
            $query = query($query);

            if (mysqli_num_rows($query) > 0) {
                // Displaying the head of the table.
                $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Size</th>
                        <th>User's Order Status</th>
                        <th>Order Action</th>
                        <th>Order Date</th>
                        <th>Delivery Date</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;
        
                // Displaying the returns in the table.
                while ($row = mysqli_fetch_assoc($query)) {
                    $cont .= <<<DELIMETER
                    <tr class="all-col-black ord_{$row['order_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['order_id']}"></th>
                        <th>{$row['order_id']}</th>
                        <th>{$row['user_full_name']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></th>
                        <th>{$row['product_quantity']}</th>
                        <th>{$row['product_size']}</th>
                        <th>{$row['order_user_status']}</th>
                        <th>{$row['order_action']}</th>
                        <th>{$row['order_date']}</th>
                        <th>{$row['order_delivery_date']}</th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There aren't any delivered orders!</h1>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                        </tbody>
                </table>
            </main>
            DELIMETER;

            echo $cont;
            break;
        
        default:
            // Data regarding the total orders.
            $to_ords = get_orders();
            $to_del_ods = get_del_orders();
            $to_ret_ods = get_ret_orders();
            $to_can_ods = get_can_orders();

            $cont = <<<DELIMETER
            <main class="main-banners flex column">
                <div class="banner-group grid">
                    <h3 class="col-black container-head bg-white">Statistics</h3>
                    <div class="banner flex column bg-white">
                        <div class="banner-head flex row jc-space-bet">
                            <h4 class="col-black">{$to_ords}</h4>
                            <svg class="fill-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        </div>
                        <h4 class="banner-text col-black">Orders</h4>
                        <div class="banner-bot flex row jc-space-bet" id="ord_all">
                            <h4>View More</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6l-128 128c-12.51 12.51-32.76 12.49-45.25 0c-12.5-12.5-12.5-32.75 0-45.25L402.8 288H32C14.31 288 0 273.7 0 255.1S14.31 224 32 224h370.8l-73.38-73.38c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l128 128C515.1 245.9 515.1 266.1 502.6 278.6z"/></svg>
                        </div>
                    </div>
                    <div class="banner flex column bg-white">
                        <div class="banner-head flex row jc-space-bet">
                            <h4 class="col-black">{$to_del_ods}</h4>
                            <svg class="fill-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        </div>
                        <h4 class="banner-text col-black">Orders Delivered</h4>
                        <div class="banner-bot flex row jc-space-bet" id="ord_del">
                            <h4>View More</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6l-128 128c-12.51 12.51-32.76 12.49-45.25 0c-12.5-12.5-12.5-32.75 0-45.25L402.8 288H32C14.31 288 0 273.7 0 255.1S14.31 224 32 224h370.8l-73.38-73.38c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l128 128C515.1 245.9 515.1 266.1 502.6 278.6z"/></svg>
                        </div>
                    </div>
                    <div class="banner flex column bg-white">
                        <div class="banner-head flex row jc-space-bet">
                            <h4 class="col-black">{$to_ret_ods}</h4>
                            <svg class="fill-red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        </div>
                        <h4 class="banner-text col-black">Orders Returned</h4>
                        <div class="banner-bot flex row jc-space-bet" id="ord_ret">
                            <h4>View More</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6l-128 128c-12.51 12.51-32.76 12.49-45.25 0c-12.5-12.5-12.5-32.75 0-45.25L402.8 288H32C14.31 288 0 273.7 0 255.1S14.31 224 32 224h370.8l-73.38-73.38c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l128 128C515.1 245.9 515.1 266.1 502.6 278.6z"/></svg>
                        </div>
                    </div>
                    <div class="banner flex column bg-white">
                        <div class="banner-head flex row jc-space-bet">
                            <h4 class="col-black">{$to_can_ods}</h4>
                            <svg class="fill-red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        </div>
                        <h4 class="banner-text col-black">Orders Cancelled</h4>
                        <div class="banner-bot flex row jc-space-bet" id="ord_can">
                            <h4>View More</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6l-128 128c-12.51 12.51-32.76 12.49-45.25 0c-12.5-12.5-12.5-32.75 0-45.25L402.8 288H32C14.31 288 0 273.7 0 255.1S14.31 224 32 224h370.8l-73.38-73.38c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l128 128C515.1 245.9 515.1 266.1 502.6 278.6z"/></svg>
                        </div>
                    </div>
                </div>
            </main>
            <main class="table-container bg-white">
                <h3 class="col-black container-head">Orders</h3>
                <table class="table bg-white">
            DELIMETER;

            // Code for displaying all the users registered.
            $query = "SELECT * FROM orders INNER JOIN ";
            $query .= "users ON orders.user_code = users.user_code INNER JOIN ";
            $query .= "products ON orders.product_code = products.product_code INNER JOIN ";
            $query .= "addressess ON orders.user_code = addressess.user_code ";
            $query .= "ORDER BY order_id DESC ";
            $query = query($query);

            if (mysqli_num_rows($query) > 0) {
                // Header of the table.
               $cont .= <<<DELIMETER
                <thead>
                    <tr class="all-col-black">
                        <th><input type="checkbox" id="all_check" style="width: 20px;"></th>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Size</th>
                        <th>Mode of Payment</th>
                        <th>Order Date</th>
                        <th>House</th>
                        <th>Road</th>
                        <th>Landmark</th>
                        <th>Pincode</th>
                        <th>City</th>
                        <th>State</th>
                        <th>User's Order Status</th>
                        <th>Order Supplier Information</th>
                    </tr>
                </thead>
                <tbody>
                DELIMETER;

                // Table content.
                while ($row = mysqli_fetch_assoc($query)) {
                    /* Formatting the button of the order to control the 
                    actions like order, cancel, deliver, return. */
                    switch ($row['order_action']) {
                        case 'unordered':
                            $btn = <<<DELIMETER
                            <a href="orders.php?a=or&c={$row['order_id']}" class="btn btn-primary">Order</a>
                            DELIMETER;
                            break;
                        case 'ordered':
                            $btn = <<<DELIMETER
                            <a href="orders.php?a=de&c={$row['order_id']}">Deliver</a>
                            <a href="orders.php?a=ca&c={$row['order_id']}">Cancel</a>
                            DELIMETER;
                            break;
                        case 'delivered':
                            /* Code for checking that a product is delivered 7 days 
                            age or not - Checking that it could be returned or not. */
                            if ((strtotime($row['order_date']) - strtotime('now')) > 7) {
                                $btn = "Order Delivered";
                            } else {
                                $btn = <<<DELIMETER
                                <a href="orders.php?a=re&c={$row['order_id']}">Return</a>
                                DELIMETER;
                            }
                            break;
                        case 'returned':
                            $btn = "Order Returned";
                            break;
                        case 'cancelled':
                            $btn = "Order Cancelled";
                            break;
                    }

                    $cont .= <<<DELIMETER
                    <tr class="all-col-black ord_{$row['order_id']}">
                        <th><input form="bulk-action" class="table_check" type="checkbox" name="check[]" value="{$row['order_id']}"></th>
                        <th>{$row['order_id']}</th>
                        <th>{$row['user_full_name']}</th>
                        <th>{$row['product_code']}</th>
                        <th>{$row['product_name']}</th>
                        <th><img src="{$row['product_img']}" width="75px" alt="{$row['product_name']}"></th>
                        <th>{$row['product_quantity']}</th>
                        <th>{$row['product_size']}</th>
                        <th>{$row['order_mod_of_pay']}</th>
                        <th>{$row['order_date']}</th>
                        <th>{$row['house_num']}</th>
                        <th>{$row['road_name']}</th>
                        <th>{$row['landmark']}</th>
                        <th>{$row['pincode']}</th>
                        <th>{$row['city']}</th>
                        <th>{$row['state']}</th>
                        <th>{$row['order_user_status']}</th>
                        <th>{$row['order_action']}</th>
                    </tr>
                    DELIMETER;
                }
            } else {
                $cont .= <<<DELIMETER
                <h1 style="text-align: center; margin-top: 50px; color: red;">There are no orders yet!</h1>
                DELIMETER;
            }

            $cont .= <<<DELIMETER
                        </tbody>
                </table>
            </main>
            DELIMETER;

            echo $cont;
            break;
    }
}
?>