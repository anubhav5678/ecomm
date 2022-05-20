<?php include("includes/assets/html-header.php"); displayTitle("Forgot Password"); ?>
<?php
// PHP code for sending user on home page if user is logged in.
if (isset($_SESSION['username'])) {
    redirect("index.php");
}
else {
    unset($_SESSION['ver_err']);
}
?>
<body>
    <section class="page-content verify-page">
        <article class="verify">
            <?php include("includes/assets/logo.php"); logo("110px"); ?>
            <?php
            /* Code for including forms for changing the password. */
            if (isset($_GET['a'])) {
                switch (escape($_GET['a'])) {
                    case 'change-password':
                        include("includes/user/change-pass.php"); # Including the change password form.
                        break;
                    case 'verify':
                        include("includes/user/verify.php"); # Including the form for verifying the email of user.
                        break;

                    default:
                        include("includes/user/check-email.php"); # Including the verify email/phone number form by default.
                        break;
                }
            } else {
                include("includes/user/check-email.php"); # Including the verify email/phone number form by default.
            }
            ?>
        </article>
        <?php
        /* Code for displaying the error when user wants to change password. */
        if (isset($_SESSION['ver_err'])) {
            switch ($_SESSION['ver_err']) {
                case 'user_acc':
                    echo <<<DELIMETER
                    <div class="error ver-err">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3 id="error-message">There is no user registered with this Email/Phone Number.</h3>
                    </div>
                    DELIMETER;
                    break;
                
                case 'code':
                    echo <<<DELIMETER
                    <div class="error ver-err">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3 id="error-message">The verification code you entered is incorrect.</h3>
                    </div>
                    DELIMETER;
                    break;
            }
        }
        ?>
        <footer class="footer-login">
            <h6>&copy; <strong id="year_of_operation"></strong>, <a href="index.php">Fashioncapital.com</a></h6>
            <script>
                var __date__ = new Date;
                document.getElementById("year_of_operation").innerHTML = "2020 - " + __date__.getFullYear();
            </script>
        </footer>
    </section>
</body>
<script src="js/verify.js"></script>
</html>