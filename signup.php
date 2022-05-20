<?php include "includes/assets/html-header.php"; displayTitle("Create An Account On Fashion Capital"); ?>
<?php
// PHP code for redirecting user back to index page if user is logged in.
if (isset($_SESSION['username'])) {
    redirect("index.php");
}
else {
    unset($_SESSION['action']);
}

/* Code when a user clicks the signup button. */
if (isset($_POST['signup'])) {
    // Setting all the user's data into sessions.
    $_SESSION['verify_username'] = escape($_POST['username']);
    $_SESSION['verify_user_phnum'] = escape($_POST['user_phnum']);
    $_SESSION['verify_user_email'] = escape($_POST['user_email']);
    $user_pass = escape($_POST['user_pass']);
    $_SESSION['verify_user_pass'] = password_hash($user_pass, PASSWORD_BCRYPT, array('cost' => 10));
    $_SESSION['verify_user_code'] = uniqid();

    $_SESSION['action'] = "verify"; # Setting the session variable of action for the verify page
    redirect("verify.php?a=r367tr"); # Redirecting to the verification page.
}
?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Signup page content -->
    <section class="page-content">
        <div class="container-form">
            <!-- Logo of website -->
            <?php include_once("includes/assets/logo.php"); logo("110px"); ?>
            <div class="form">
                <!-- Signup Form -->
                <h1>Sign Up</h1>
                <form action="" method="POST" id="signup-form">
                    <div class="form-group">
                        <label for="username"><strong>Your Name</strong></label>
                        <div class="input" id="username-container">
                            <i class="fas fa-user"></i>
                            <input type="text" name="username" id="username" placeholder="Your Full Name">
                        </div>
                        <p id="err-username"></p>
                    </div>
                    <div class="form-group">
                        <label for="phnum"><strong>Mobile Phone Number</strong></label>
                        <div class="input" id="phnum-container">
                            <p>+91</p>
                            <input type="tel" name="user_phnum" id="phnum" max="10" placeholder="Your Phone Number">
                        </div>
                        <p id="err-phnum"></p>
                    </div>
                    <div class="form-group">
                        <label for="user_email"><strong>Email</strong></label>
                        <div class="input" id="email-container">
                            <i class="fas fa-at"></i>
                            <input type="email" name="user_email" id="user_email" value="" placeholder="example@email.com">
                        </div>
                        <p id="err-email"></p>
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>Password</strong></label>
                        <div class="input" id="pass-container">
                            <i class="fas fa-key"></i>
                            <input type="password" name="user_pass" id="password" placeholder="Atleast 6 characters" autocomplete="on">
                        </div>
                        <p id="err-password"></p>
                    </div>
                    <div class="form-group">
                        <p><strong>We will send you a verification code at your email address to verify your account.</strong></p>
                    </div>
                    <div class="form-group">
                        <input class="submit" type="submit" name="signup" value="Sign Up" id="signup-btn" disabled>
                    </div>
                </form>
            </div>

            <div class="other">
                <h5>Already have an account?</h5>
                <a href="login.php"><strong>Login</strong></a>
            </div>
            <!-- Login page -->
        </div>

        <!-- Login page footer. -->
        <footer class="footer-login">
            <h6>&copy; <strong id="year_of_operation"></strong>, <a href="index.php">Fashioncapital.com</a></h6>
            <script>
            var __date__ = new Date;
            document.getElementById("year_of_operation").innerHTML = "2020 - " + __date__.getFullYear();
            </script>
        </footer>
    </section>
</body>
<script src="js/script.js"></script>
<script src="js/signUpValidation.js"></script>
</html>