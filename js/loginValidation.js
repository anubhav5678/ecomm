// Script for validating fields every millisecond 0r 0.1 second.
setInterval(() => {
    validateUser();
}, 100);

/* Function for validating that a user isregisterd
or not and all the fields are filled are not. */
function validateUser () {
    var user = $("#email_phnum").val();
    var pass = $("#password").val();
    if (user == "" || pass == "") {
        document.getElementById("login-btn").disabled = true;
    } else {
        $.post("includes/user/user_validation.php", {"user" : user},
            function (response) {
                if (response == 0) {
                    document.getElementById("err-user").style.display = "block";
                    $("#err-user").text("This user doesn't exists.");
                    document.getElementById("login-btn").disabled = true;
                    document.getElementById("user-container").style["border-color"] = "var(--warning-color)";
                }
                else {
                    document.getElementById("err-user").style.display = "none";
                    document.getElementById("login-btn").disabled = false;
                    document.getElementById("user-container").style["border-color"] = "var(--accent-color)";
                }
            }
        );
    }
}

/* Function for sending username and password
to validation page for logging user in. */
var loader = '<div class="spinner-container" id="loader" style="width: 100%;"><div class="pulse-container"><div class="pulse-bubble pulse-bubble-1"></div><div class="pulse-bubble pulse-bubble-2"></div><div class="pulse-bubble pulse-bubble-3"></div></div></div>';
$("#login-btn").click(function () {
    var user = $("#email_phnum").val();
    var pass = $("#password").val();
    $("#login-btn").html(loader);

    $("#login-form").submit(function () { 
        $.post("includes/user/login_func.php", {"u" : user, "p" : pass},
            function (response) {
                console.log(response);
                if (response == 0) {
                    document.getElementById("error").style.display = "flex";
                    $("#error-message").text("The username or password is incorrect.");
                    $("#login-form").trigger("reset");
                    $("#login-btn").text("Login");
                }
                else {
                    window.history.back();
                }
            }
        );
        return false;
    });
});