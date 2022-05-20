<?php
// Function for displaying the warning regarding the order
function warning($t)
{
    echo <<<DELIMETER
    <section class="cart-empty-warning">
        <h1 style="text-align: center; width: 100%;">{$t}</h1>
        <img src="img/empty_cart.webp" width="100px" alt="">
        <a class="a-link" href="index.php">Continue Shopping</a>
    </section>
    DELIMETER;
}
?>