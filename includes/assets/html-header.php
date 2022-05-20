<?php include "includes/config/db.php"; ?>
<?php include "includes/config/functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="author" content="Anubhav Shavaran">
    <meta name="theme-color" content="rgb(3, 169, 244)">
    <meta name="author" content="Anubhav Shavaran">
    <meta name="description" content="We are Fashion Capital, the # 1 Fashion Website. We brought to you the Handpicked Exclusive Premium quality Fashionable Wears and Accessories at a reasonably affordable price.">
    <?php
    /* Function for displaying a specific title over the pages. */
    function displayTitle($t = "Fashion Capital") // Setting the title to Fashion Capital by default.
    {
        echo <<<DELIMETER
        <title>{$t}</title>
        DELIMETER;
    }
    ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/fc-favicon.ico" type="image/x-icon">
    <script src="js/icons.js"></script>
    <script src="js/jquery.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>