<?php
include("../config/db.php");
include("../config/functions.php");

// Code for checking that a user exsits in the database or not when logging in.
if (isset($_REQUEST['user'])) {
    $user = escape($_REQUEST['user']);

    $query = query("SELECT user_code FROM users WHERE user_email = '{$user}' OR user_phnum = '{$user}' ");
    if (mysqli_num_rows($query) == 0 || empty($query)) {
        echo 0;
    } else {
        echo 1;
    }
}

// Code for checking that a phone number is stored already by another user.
if (isset($_REQUEST['phNum'])) {
    $phNum = escape($_REQUEST['phNum']);

    $query = query("SELECT user_phnum FROM users WHERE user_phnum = '{$phNum}' ");
    if (mysqli_num_rows($query) >= 1) {
        echo 0;
    } else {
        echo 1;
    }
}

// Code for checking that a email is stored already by another user.
if (isset($_REQUEST['email'])) {
    $email = escape($_REQUEST['email']);

    $query = query("SELECT user_email FROM users WHERE user_email = '{$email}' ");
    if (mysqli_num_rows($query) >= 1) {
        echo 0;
    } else {
        echo 1;
    }
}
?>