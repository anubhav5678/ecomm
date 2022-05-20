<?php
// Code executes when continue button is clicked.
if (isset($_POST['return_product'])) {
    /* Query for adding the reason and comment 
    to database for returning a product. */
    $oi = escape($_GET['c']);
    $reason = escape($_POST['reason']);
    $comment = escape($_POST['comment']);
    $accnum = escape($_POST['acc_num']);
    $query = query("INSERT INTO `returns`(`order_id`, `user_code`, `reason`, `comments`, `account_num`) VALUES ('{$oi}', '{$_SESSION['user_code']}', '{$reason}', '{$comment}', '{$accnum}') ");
    confirmQuery($query);

    /* Query for updating the orders table for returned product. */
    $query = query("UPDATE orders SET order_user_status = 'returned', order_user_date = NOW() WHERE order_id = '{$oi}' ");
    confirmQuery($query);

    // Redirecting the user back to the orders main page.
    redirect("my_orders.php");
}
?>
<form action="" method="POST" class="return-form" autocomplete="on">
    <h2>Return this Product</h2>
    <div class="form-group">
        <label>Why are you returning this product?</label>
        <div class="input">
            <select name="reason" id="reason">
                <option value="">Select the reason.</option>
                <option value="Product was different from the image.">Product was different from the image.</option>
                <option value="Product's price was very high.">Product's price was very high.</option>
                <option value="Product was damaged.">Product was damaged.</option>
                <option value="This product was being sold at any other website.">This product was being sold at any other website.</option>
                <option value="You didn't liked the product.">You didn't liked the product.</option>
                <option value="Product's size was not correct.">Product's size was not correct.</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>Comments</label>
        <div class="input">
            <textarea name="comment" id="comment" cols="20" rows="10"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label>Your Account Number</label>
        <div class="input">
            <input type="number" name="acc_num">
        </div>
        <p><h5>We need your Bank Account Number for transfering the money after you return the product. None of your Bank Details are recorded.</h5></p>
    </div>
    <input type="submit" class="submit" name="return_product" value="Continue" disabled>
</form>