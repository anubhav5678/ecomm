<?php
/* Code for checking that a user exits or not with the
email or phone number specified by the user in the form. */
if (isset($_POST['verify_user'])) {
    $fuser = escape($_POST['forgotten_user']); # Getting the email or phone number of the forgotten user.

    $query = query("SELECT * FROM users WHERE user_email = '{$fuser}' OR user_phnum = '{$fuser}' ");
    if (mysqli_num_rows($query) != 0) {
        $row = mysqli_fetch_array($query);
        $_SESSION['alter_user_email'] = $row['user_email'];
        redirect("forgot-pass.php?a=verify&ert=6etr73");
    }
    else {
        $_SESSION['ver_err'] = "user_acc"; # Setting session for displaying the error.
    }
}
?>
<nav>
    <h2>Verify it's you</h2>
</nav>
<form action="" method="POST">
    <div class="form-group">
        <label for="frus">Enter Email or Phone number</label>
        <div class="input">
            <i class="fas fa-user"></i>
            <input type="text" name="forgotten_user" id="frus" placeholder="Email/Phone number">
        </div>
    </div>
    <div class="form-group">
        <input class="submit" type="submit" name="verify_user" value="Verify" disabled>
    </div>
</form>