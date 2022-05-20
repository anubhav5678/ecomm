<?php
// Including important files.
include("../config/db.php");
include("../config/functions.php");

// Code for logging a user in.
if (isset($_REQUEST['u'])) {
    $user_key = escape($_REQUEST['u']);
    $user_pass = escape($_REQUEST['p']);

    $query = "SELECT * FROM users WHERE user_email = '{$user_key}' OR user_phnum = '{$user_key}' ";
    $run = mysqli_query($connection, $query);
    confirmQuery($query);

    while ($row = mysqli_fetch_assoc($run)) {
        $db_user_id = $row['user_id'];
        $db_user_code = $row['user_code'];
        $db_username = $row['user_full_name'];
        $db_user_phnum = $row['user_phnum'];
        $db_user_email = $row['user_email'];
        $db_password = $row['user_password'];
        $db_user_role = $row['user_role'];

        if (password_verify($user_pass, $db_password)) {
            $_SESSION['user_code'] = $db_user_code;
            $_SESSION['username'] = $db_username;
            $_SESSION['user_role'] = $db_user_role;

            echo 1;
        }
        else {
            echo 0;
        }
    }
}
?>