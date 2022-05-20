<?php
// Query for displaying all the data of address of a user.
$query = query("SELECT * FROM addressess WHERE user_code = '{$_SESSION['user_code']}' ");
confirmQuery($query);

while ($row = mysqli_fetch_assoc($query)) {
    $h_num = $row['house_num'];
    $r_name = $row['road_name'];
    $l_mark = $row['landmark'];
    $p_code = $row['pincode'];
    $city = $row['city'];
    $state = $row['state'];
}

// Query for updating the user data of address.
if (isset($_POST['update_address'])) {
    $h_num = escape($_POST['user_hnum']);
    $r_name = escape($_POST['user_road']);
    $l_mark = escape($_POST['user_landmark']);
    $p_code = escape($_POST['user_pcode']);
    $city = escape($_POST['user_city']);
    $state = escape($_POST['user_state']);

    $query = "UPDATE `addressess` SET ";
    $query .= "`house_num`= '{$h_num}', `road_name`='{$r_name}', `landmark`='{$l_mark}', ";
    $query .= "`pincode`='{$p_code}', `city`='{$city}', `state`='{$state}' ";
    $query .= "WHERE user_code = '{$_SESSION['user_code']}' ";
    $query = query($query);
    confirmQuery($query);

    redirect("my_addressess.php");
    unset($_SESSION['add_action']);
}
?>
<section class="container-form">
    <div class="form" style="border: none;">
        <form class="form" action="" method="post" style="border: none;">
            <h1 style="width: 100%; text-align: center;">Edit Address</h1>
            <div class="form-group">
                <label for="hnum"><strong>House no./ Building Name</strong></label>
                <div class="input">
                    <input type="text" name="user_hnum" id="hnum" value="<?php echo $h_num; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="road"><strong>Road Name/ Area/ Colony</strong></label>
                <div class="input">
                    <input type="text" name="user_road" id="road" value="<?php echo $r_name; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="landmark"><strong>Landmark</strong></label>
                <div class="input">
                    <input type="text" name="user_landmark" id="landmark" value="<?php echo $l_mark; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="pincode"><strong>Pin Code</strong></label>
                <div class="input">
                    <input type="number" name="user_pcode" id="pincode" maxlength="6" value="<?php echo $p_code; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="city"><strong>City</strong></label>
                <div class="input">
                    <input type="text" name="user_city" id="city" value="<?php echo $city; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="states"><strong>State</strong></label>
                <div class="input">
                    <select id="states" name="user_state">
                        <option value="">Select state</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <input class="submit" name="update_address" type="submit" id="save-address" value="Save Address" disabled>
            </div>
        </form>
    </div>
</section>