<?php include "includes/assets/html-header.php"; displayTitle("Login To Your Account"); ?>
<?php
// PHP code for sending user on home page if user is logged in.
if (isset($_SESSION['username'])) {
    redirect("index.php");
}
?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Login page content -->
    <section class="page-content">
        <div class="container-form">
            <!-- Logo of website -->
            <?php include_once("includes/assets/logo.php"); logo("110px"); ?>
            <div class="form">
                <h1>Login</h1>
                <form id="login-form" action="" method="POST" autocomplete="on">
                    <div class="form-group">
                        <label for="email_phnum"><strong>Email ID Or Phone Number</strong></label>
                        <div class="input" id="user-container">
                            <i class="fas fa-user"></i>
                            <input type="text" name="user_key" id="email_phnum" value="" placeholder="Email/Phone Number">
                        </div>
                        <p id="err-user"></p>
                    </div>
                    <div class="form-group" id="pass-container">
                        <label for="password"><strong>Password</strong></label>
                        <div class="input">
                            <i class="fas fa-key"></i>
                            <input type="password" name="user_pass" id="password" placeholder="*******">
                        </div>
                    </div>
                    <div class="form-group">
                        <button formaction="#login-form" class="submit" id="login-btn" disabled>Login</button>
                    </div>
                </form>
            </div>

            <!-- Error div for displaying error while submiting the form. -->
            <div class="error" id="error">
                <i class="fas fa-exclamation-triangle"></i>
                <h3 id="error-message"></h3>
            </div>

            <div class="other" style="margin-bottom: -5px;">
                <a href="forgot-pass.php">Forgot Password?</a>
            </div>
            <div class="other">
                <h5>New to Fashion capital?</h5>
                <a href="signup.php"><strong>Create an Account</strong></a>
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
<script src="js/loginValidation.js"></script>
</html>