<?php
/* Code for changing the password. */
if (isset($_POST['change_password'])) {
    $chpass = escape($_POST['new_password']); # Getting the new password of the user.
    $chpass = password_hash($chpass, PASSWORD_BCRYPT, array('cost' => 10)); # Encrypting the new password.
    // Query for updating the new password.
    $query = query("UPDATE users SET user_password = '{$chpass}' WHERE user_email = '{$_SESSION['alter_user_email']}' ");
    confirmQuery($query);

    redirect("login.php"); # Redirecting the user to login page for logging user in.
}
?>
<nav>
    <h2>Set your new password</h2>
</nav>
<form action="" method="POST">
    <div class="form-group">
        <label for="chpass">Enter New Password</label>
        <div class="input">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z"/></svg>
            <input type="password" name="new_password" id="chpass" placeholder="*******">
        </div>
        <p id="err-password"></p>
    </div>
    <div class="form-group">
        <input class="submit" type="submit" name="change_password" value="Change Password" disabled>
    </div>
</form>