<?php
/* Including the files required. */
include("../config/db.php");
include("../config/functions.php");

/* Code for altering the user data of a user. */
if (isset($_POST['a'])) {
    // Checking the user data to be changed.
    switch ($_POST['a']) {
        case 'name': // Changing the name of the user.
            $uname = escape($_POST['v']); // User specified changed name.
            // Query for changing the name of the user.
            $query = query("UPDATE users SET user_full_name = '{$uname}' WHERE user_code = '{$_SESSION['user_code']}' ");
            confirmQuery($query);
            // Setting the session of username with new name. 
            $_SESSION['username'] = $uname;
            break;
    }
}
?>