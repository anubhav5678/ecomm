<?php include("includes/assets/html-header.php"); displayTitle("Add Address"); ?>
<body>
    <?php
    // Code for adding the user's address when user buys a product.
    if (isset($_POST['save_address'])) {
        $h_num = escape($_POST['h_num']);
        $r_name = escape($_POST['r_name']);
        $landmark = escape($_POST['landmark']);
        $p_code = escape($_POST['p_code']);
        $city = escape($_POST['city']);
        $state = escape($_POST['state']);

        $query = "INSERT INTO `addressess`(`user_code`, `house_num`, `road_name`, `landmark`, `pincode`, `city`, `state`) ";
        $query .= "VALUES ('{$_SESSION['user_code']}', '{$h_num}', '{$r_name}', '{$landmark}', '{$p_code}', '{$city}', '{$state}') ";
        $query = query($query);
        confirmQuery($query);

        redirect("order_summary.php");
    }
    ?>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Add address content -->
    <section class="page-content">
        <!-- The summary order navbar -->
        <?php include("includes/assets/navbar-sl.php"); nav("Add Address"); ?>

        <!-- Form for adding user address -->
        <section class="container-form" style="padding-top: 55px;">
            <div class="form" style="border: none; padding: 0px;">
                <form class="form" action="" method="post" style="border: none; padding: 0px;" autocomplete="on">
                    <div class="form-group">
                        <label for="address"><strong>House no./ Building Name</strong></label>
                        <div class="input">
                            <input type="text" name="h_num" id="hnum" placeholder="House no./ Building Name(Required)*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="r_name"><strong>Road Name/ Area/ Colony</strong></label>
                        <div class="input">
                            <input type="text" name="r_name" id="road" placeholder="Road Name/ Area/ Colony(Required)*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="landmark"><strong>Landmark</strong></label>
                        <div class="input">
                            <input type="text" name="landmark" id="landmark" placeholder="Landmark(Optional)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pin-code"><strong>Pin Code</strong></label>
                        <div class="input">
                            <input type="number" name="p_code" id="pincode" maxlength="6" placeholder="Pin Code(Required)*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city"><strong>City</strong></label>
                        <div class="input">
                            <input type="text" name="city" id="city" placeholder="City(Required)*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="states"><strong>State</strong></label>
                        <div class="input">
                            <select id="states" name="state">
                                <option value="">Select state</option>
                                <option value="Maharashtra">Maharashtra</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="save_address" class="submit" id="save-address" value="Save Address" disabled>
                    </div>
                </form>
            </div>
        </section>
    </section>
</body>
<script>
    const p = "a";
</script>
<script src="js/address.js"></script>
</html>