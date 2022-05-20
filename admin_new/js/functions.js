/* Script for checking a checkbox inside a "th" tag when it is clicked. */
// Getting all the "th" tags containing checkboxes.
var thfc = document.querySelectorAll("tbody tr th:first-child");
// Event when a "th" tag is clicked.
for (let k = 0; k < thfc.length; k++) {
    thfc[k].onclick = () => {
        var cch = thfc[k].childNodes[0]; // Getting the checkbox inside the "th" tag.
        // Getting all the "th" tags in the row whose "th" tag is clicked.
        var ths = thfc[k].parentNode.querySelectorAll("th");
        // Checking that the clicked checkbox is checked or not. 
        if (cch.checked) {
            cch.checked = false; // Unchecking the checkbox if it's checked.
            checkBox(); // Function for checking that all the checkboxes are checked or not.
            // Removing the border-left of the container of checkbox.
            thfc[k].style["border-left"] = "";
            // Removing the background-color of every "th" tag in the row of unchecked checkbox.
            for (let l = 0; l < ths.length; l++) {
                ths[l].style["background-color"] = "";
            }
        } else {
            cch.checked = true; // Checking the checkbox if it's unchecked.
            checkBox(); // Function for checking that all the checkboxes are checked or not.
            // Adding a border-left to the container of checkbox.
            thfc[k].style["border-left"] = "3.5px solid var(--selected-color)";
            // Setting the background-color of every "th" tag in the row of checked checkbox.
            for (let l = 0; l < ths.length; l++) {
                ths[l].style["background-color"] = "rgb(196 196 196 / 10%)";
            }
        }
    }
}

/* Script for checking all the checkbox when check all button is clicked. */
// Getting all the checkboxes in the table.
var cb = document.getElementsByClassName("table_check");
// Getting the check all checkbox.
var ac = document.querySelector("input[type='checkbox']#all_check");
// Event when check all checkbox is clicked.
if (ac != null) {
    ac.onclick = () => {
        // Checking that it's checked or not.
        if (ac.checked) {
            // Iterating through all the checkboxes and checking them.
            for (let m = 0; m < cb.length; m++) {
                cb[m].checked = true;
                // Getting all the "th" tags in the row of the checkbox.
                var thb =cb[m].parentNode.parentNode.querySelectorAll("th");
                // Setting a background color in all the "th" tags of the row.
                for (let n = 0; n < thb.length; n++) {
                    thb[n].style["background-color"] = "rgb(196 196 196 / 10%)";
                }
                // Adding a border-left in the "th" tag of checkbox.
                cb[m].parentNode.style["border-left"] = "3.5px solid var(--selected-color)";
            }
        } else {
            // Iterating through all the checkboxes and unchecking them.
            for (let m = 0; m < cb.length; m++) {
                cb[m].checked = false;
                var thb =cb[m].parentNode.parentNode.querySelectorAll("th");
                // Removing the background color from all the "th" tags of the row.
                for (let n = 0; n < thb.length; n++) {
                    thb[n].style["background-color"] = "";
                }
                // Removing the border-left from the "th" tag of checkbox.
                cb[m].parentNode.style["border-left"] = "";
            }
        }
    }
}

/* Function for checking that all checkboxes are checked or 
not and checking/unchecking the check all checkbox. */
function checkBox () {
    // Getting all the checkboxes in the table.
    var alcb = document.getElementsByClassName("table_check");
    var chec = ""; // Container for the result after checking for all the checkboxes.

    // Iterating through all the checkboxes and getting that all are checked or not.
    for (let i = 0; i < alcb.length; i++) {
        if (alcb[i].checked) {
            chec = true; // Setting the container true if all are checked.
        } else {
            chec = false; // Setting the container false and breaking the loop if a single checkbox is unchecked.
            break;
        }
    }
    // Checking/Unchecking the check all checkbox if all the checkboxes are checked.
    if (chec) {
        document.getElementById("all_check").checked = true;
    } else {
        document.getElementById("all_check").checked = false;
    }
}