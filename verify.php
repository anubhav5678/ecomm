<?php include("includes/assets/html-header.php"); displayTitle("Verify Your Email"); ?>
<?php
/* Code for restricting the user from coming at the verification page without any use. */
if (isset($_SESSION['user_code']) || !isset($_SESSION['action'])) {
    if (isset($_SERVER['HTTP_REFERER'])) { # Sending user to the last page if there.
        redirect($_SERVER['HTTP_REFERER']);
    } else { # Sending user to the home page.
        redirect("index.php");
    }
}
unset($_SESSION['ver_err']); # Unsetting the verify error session.
// Including all the files needed for PHPMailer.
require_once("vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("vendor/phpmailer/phpmailer/src/Exception.php");
require_once("vendor/phpmailer/phpmailer/src/SMTP.php");

// Using the Classes.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/* Creating user's account when the code sent is correct. */
if (isset($_POST['verify_account'])) {
    $ver_code = escape($_POST['ver_code']); # Getting the verification code entered by the user.

    // Code when user inputs correct verification code.
    if ($_SESSION['ver_code'] == $ver_code) {
        // Query for inserting the user's data into database.
        $query = query("INSERT INTO `users`(`user_code`, `user_full_name`, `user_phnum`, `user_email`, `user_password`, `user_role`) VALUES('{$_SESSION['verify_user_code']}', '{$_SESSION['verify_username']}', '{$_SESSION['verify_user_phnum']}', '{$_SESSION['verify_user_email']}', '{$_SESSION['verify_user_pass']}', 'buyer') ");
        confirmQuery($query);

        // Logging user in after signup.
        if ($query) {
            $_SESSION['user_code'] = $_SESSION['verify_user_code'];
            $_SESSION['username'] = $_SESSION['verify_username'];
            $_SESSION['user_role'] = 'buyer';

            // Destroying all the sessions required for verifying a user.
            foreach ($_SESSION as $key => $value) {
                if (substr($key, 0, 7) == "verify_") {
                    unset($_SESSION[$key]);
                }
            }
            unset($_SESSION['ver_err']);

            redirect("index.php"); # Redirecting to the home page.
        }
        else {
            redirect("signup.php"); # Redirecing back to the signup page.
        }
    }
    else { # Code when the verification code is incorrect.
        $_SESSION['ver_err'] = true;
    }
}
/* Sending the verification key only when it's required - on redirect from signup. */
elseif (isset($_GET['a'])) {
    /* Creating a random code sending it to the user's email to verify the user. */
    $_SESSION['ver_code'] = ""; # The verification code container to be sent.
    for ($i=0; $i < 5; $i++) { 
        $_SESSION['ver_code'] .= rand(2,8);
    }

    $mail = new PHPMailer(); # PHPMailer class
    $mail->isSMTP(); 
    $mail->Host = "smtp.gmail.com"; # Host name.
    $mail->SMTPAuth = true; # Host Authentication
    $mail->SMTPSecure = "tls"; # Host Security.
    $mail->Port = "587"; # Host Port.
    $mail->Username = "fashioncapital2022@gmail.com"; # Sender's Email.
    $mail->Password = "fashioncapital00"; # Sender's Password.
    $mail->Subject = "Your Verification Code"; # E-mail Subject.
    $mail->setFrom("Fashion Capital"); # Email setfrom.
    $mail->isHTML(true); # Setting HTML to be send - True.
    $mail->Body = "<h1>Fashion Capital</h1><h3>Your verification code for creating an account at Fashion Capital is {$_SESSION['ver_code']}.</h3>"; # E-mail Body.
    $mail->addAddress($_SESSION['verify_user_email']); # Reciever's email
    
    // Checking that te email was sent or not.
    if (!$mail->send()) {
        echo "Error" . $mail->ErrorInfo;
    }
    $mail->smtpClose(); # Closing the smtp.
}
?>
<body>
    <section class="page-content verify-page">
        <article class="verify">
            <?php include("includes/assets/logo.php"); logo("110px"); ?>
            <nav>
                <h2>We have sent you an email at:</h2>
                <h3><?php echo isset($_SESSION['verify_user_email']) ? $_SESSION['verify_user_email'] : "" ; ?></h3>
            </nav>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="code">Enter The Verification Code</label>
                    <div class="input">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z"/></svg>
                        <input type="number" name="ver_code" id="code">
                    </div>
                </div>
                <div class="form-group">
                    <input class="submit" type="submit" name="verify_account" value="Verify" disabled>
                </div>
            </form>
        </article>
        <?php
        /* Code for displaying the error when user inserts incorrect verification code. */
        if (isset($_SESSION['ver_err']) && $_SESSION['ver_err'] == true) {
            echo <<<DELIMETER
            <div class="error ver-err">
                <i class="fas fa-exclamation-triangle"></i>
                <h3 id="error-message">The verification code you entered is incorrect.</h3>
            </div>
            DELIMETER;
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