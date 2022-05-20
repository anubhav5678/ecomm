// Calling functions every second for validating fields.
setInterval(() => {
    validateFields();
}, 500);
// Variables for getting the boolean value of validating functions.
var phNumCheck = false;
var emailCheck = false;

// Function for validating fields for correct input.
function validateFields () {

    var username = $("#username").val();
    var user_phnum = $("#phnum").val();
    var user_email = $("#user_email").val();
    var user_pass = $("#password").val();

    if (username == "" || user_phnum == "" || user_email == "" || user_pass == "") {
        document.getElementById("signup-btn").disabled = true;
    }
    else {
        validatePhNum();
        validateEmail();
        validatePass();
        if (validatePhNum() == false || validateEmail() == false || validatePass() == false) {
            document.getElementById("signup-btn").disabled = true;
        }
        else {
            document.getElementById("signup-btn").disabled = false;
        }
    }
}

// Function for validating the phone number entered by user.
function validatePhNum () {
    
    var phNum = $("#phnum").val();
    if (phNum != "") {
        if (phNum.length < 10 || phNum.length > 10) {
            document.getElementById("err-phnum").style.display = "block";
            $("#err-phnum").text("This Phone Number is not valid.");
            document.getElementById("phnum-container").style["border-color"] = "var(--warning-color)";
            phNumCheck = false;
        }
        else {
            $.post("includes/user/user_validation.php", {"phNum" : phNum},
                function (response) {
                    if (response == 0) {
                        document.getElementById("err-phnum").style.display = "block";
                        $("#err-phnum").text("This Phone Number is already taken.");
                        document.getElementById("phnum-container").style["border-color"] = "var(--warning-color)";
                        phNumCheck = false;
                    } else {
                        document.getElementById("err-phnum").style.display = "none";
                        document.getElementById("phnum-container").style["border-color"] = "var(--accent-color)";
                        $("#err-phnum").text("");
                        phNumCheck = true;
                    }
                }
            );
        }
    }
    return phNumCheck;
}

// Function for validating the email entered by user.
function validateEmail () {

    var email = $("#user_email").val();
    if (email != "") {
        $.post("includes/user/user_validation.php", {"email" : email},
            function (response) {
                if (response == 0) {
                    document.getElementById("err-email").style.display = "block";
                    $("#err-email").text("This E-mail account is already taken.");
                    document.getElementById("email-container").style["border-color"] = "var(--warning-color)";
                    emailCheck = false;
                } else {
                    document.getElementById("err-email").style.display = "none";
                    document.getElementById("email-container").style["border-color"] = "var(--accent-color)";
                    $("#err-email").text("");
                    emailCheck = true;
                }
            }
        );
    }
    return emailCheck;
}

// Function for validating password entered by user.
function validatePass () {
    var pass = $("#password").val();
    if (pass != "") {
        if (pass.length < 8) {
            document.getElementById("err-password").style.display = "block";
            $("#err-password").text("The password must be containing 8 characters.");
            document.getElementById("pass-container").style["border-color"] = "var(--warning-color)";
            passCheck = false;
        }
        else {
            document.getElementById("err-password").style.display = "none";
            document.getElementById("pass-container").style["border-color"] = "var(--accent-color)";
            $("#err-password").text("");
            passCheck = true;
        }
    }
    return passCheck;
}