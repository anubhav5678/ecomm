/* Script for preventing the form submission with an empty input field. */
/* This is for both verification of code for signup and code for changing the password. */
var vci = document.querySelector("input#code");
var vcs = document.querySelector("input[type='submit'].submit"); // Getting the submit button on all the pages of verification.
// Checking the length of value of verification code input field at every half second.
if (vci != undefined && vci != null) {
    setInterval(() => {
        if (vci.value.length < 5) {
            vcs.disabled = true; // Disabling the submit button if length is smaller than 5.
        } else {
            vcs.disabled = false; // Enabling the submit button if length is greater than 5.
        }
    }, 500)
}

/* Script for preventing the user from submitting check user's email/phone number field empty. */
var ve = document.querySelector("input#frus"); // Verifying email/phone number field.
// Checking the length of value of verification code input field at every half second.
if (ve != undefined && ve != null) {
    setInterval(() => {
        if (ve.value.length == 0) {
            vcs.disabled = true; // Disabling the submit button if length is 0.
        } else {
            vcs.disabled = false; // Enabling the submit button if length is greater than 0.
        }
    }, 500)
}

/* Script for preventing the user from submitting the change password form empty. */
var vcp = document.querySelector("input#chpass"); // New password field.
// Checking the length of value of verification code input field at every half second.
if (vcp != undefined && vcp != null) {
    setInterval(() => {
        if (vcp.value.length == 0) {
            vcs.disabled = true; // Disabling the submit button if length is 0.
        } else {
            if (vcp.value.length < 8) {
                vcs.disabled = true; // Disabling the submit button if length of new passsword is smaller than 8.
                // Displaying the message that password is small.
                document.querySelector("p#err-password").innerHTML = "The password must be containing 8 characters.";
            } else {
                // Hiding the warning about the new password.
                document.querySelector("p#err-password").innerHTML = "";
                vcs.disabled = false; // Enabling the submit button if length is correct.
            }
        }
    }, 500)
}

// Script for preventing the form resubmission dialog box.
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}