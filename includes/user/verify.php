<?php
// Including all the files needed for PHPMailer.
require_once("vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("vendor/phpmailer/phpmailer/src/Exception.php");
require_once("vendor/phpmailer/phpmailer/src/SMTP.php");

// Using the Classes.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['verify_account'])) {
    $ver_code = escape($_POST['ver_code']); # Getting the verification code entered by the user.
    if ($_SESSION['ver_code'] == $ver_code) {
        redirect("forgot-pass.php?a=change-password");
    } else {
        $_SESSION['ver_err'] = "code";
    }
}
elseif (isset($_GET['ert'])) {
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
    # E-mail Body.
    $mail->Body = <<<DELIMETER
    <h1>Fashion Capital</h1>
    <h3>
        Your verification code for changing your account's password with 
        email address {$_SESSION['alter_user_email']} is {$_SESSION['ver_code']}.
    </h3>
    DELIMETER;
    $mail->addAddress($_SESSION['alter_user_email']); # Reciever's email
    
    // Checking that te email was sent or not.
    if (!$mail->send()) {
        echo "Error" . $mail->ErrorInfo;
    }
    $mail->smtpClose(); # Closing the smtp.
}
?>
<nav>
    <h2>We have sent you an email at:</h2>
    <h3><?php echo isset($_SESSION['alter_user_email']) ? $_SESSION['alter_user_email'] : "" ; ?></h3>
</nav>
<form action="" method="POST">
    <div class="form-group">
        <label for="code">Enter The Verification Code</label>
        <div class="input">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z"/></svg>
            <input type="number" name="ver_code" id="code" placeholder="*******">
        </div>
    </div>
    <div class="form-group">
        <input class="submit" type="submit" name="verify_account" value="Verify" disabled>
    </div>
</form>