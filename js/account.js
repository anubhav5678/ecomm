/* Script for editing the name of a user in the my account page. */
var es = document.querySelectorAll(".acc-data-child svg") // Getting all the edit data buttons.
var is = document.querySelectorAll("input") // Getting all the input fields of user's data.

for (let i = 0; i < es.length; i++) {
    es[i].onclick = () => {
        is[i].readOnly = false; // Making the input field editable.
        is[i].focus(); // Focusing on the input field.

        is[i].onkeyup = (e) => {
            if (e.key == "Enter") {
                var va = is[i].value; // Getting the value of the input field.
                // Sending the value on the basis of field.
                switch (is[i].getAttribute("id")) {
                    case "name": // Sending the name.
                        $.post("includes/other/account_data.php", {"a" : "name", "v" : va}, () => {is[i].value = va});
                        break;
                    case "ph_num": // Sending the phone number.
                        $.post("includes/other/account_data.php", {"a" : "ph_num", "v" : va}, () => {is[i].value = va});
                        break;
                    case "email": // Sending the email.
                        $.post("includes/other/account_data.php", {"a" : "email", "v" : va}, () => {is[i].value = va});
                        break;
                }
                is[i].readOnly = true; // Making the input field uneditable.
                is[i].blur(); // Removing the focus from input field.
            } else if (e.key == "Escape") { // Event when escape or mobile backey is pressed.
                is[i].readOnly = true; // Making the input field uneditable.
                is[i].blur(); // Removing the focus from input field.
            }
        }
    }
}

/* Script for redirecting the user on previous 
page on clicking the back arrow button. */
document.getElementById("back-btn").onclick = () => {
    window.history.back();
}