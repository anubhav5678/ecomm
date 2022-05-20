// Script for showing a loader when the page loads.
$(document).ready(function() {
    $("#loader").css("display", "none");
});

// Script for adding all the states to the state selection menu in add address page.
var ss = document.getElementById("states");
$.ajax({
    type: "get",
    url: "https://countriesnow.space/api/v0.1/countries/states",
    dataType: "json",
    success: function (data) {
        var states = data.data[99].states;
        if (p == "m") {
            for (let i = 0; i < states.length; i++) {
                if (states[i].name == st && st != null) {
                    ss.innerHTML += "<option value='" + states[i].name + "' selected>" + states[i].name + "</option>";
                } else {
                    ss.innerHTML += "<option value='" + states[i].name + "'>" + states[i].name + "</option>";
                }
            }
        }
        else {
            for (let i = 0; i < states.length; i++) {
                ss.innerHTML += "<option value='" + states[i].name + "'>" + states[i].name + "</option>";
            }
        }
    }
});

/* Script for enabling/disabling the save address button in edit/add address page. */
if (window.location.href.includes("edit") || window.location.href.includes("add") || window.location.href.includes("add_address.php")) {
    // Setting the time interval for every half second.
    setInterval(() => {
        // Getting the address data values.
        var hn = document.getElementById("hnum").value;
        var rn = document.getElementById("road").value;
        var lm = document.getElementById("landmark").value;
        var pc = document.getElementById("pincode").value;
        var ct = document.getElementById("city").value;
        var st = document.getElementById("states").value;
    
        // Enabling/disabling the update address button.
        if (hn == "" || rn == "" || lm == "" || pc == "" || ct == "" || st == "") {
            document.getElementById("save-address").disabled = true;
        } else {
            document.getElementById("save-address").disabled = false;
        }
    }, 500)
}

/* Script for redirecting the user on previous 
page on clicking the back arrow button. */
document.getElementById("back-btn").onclick = () => {
    console.log("back");
    window.history.back();
}

// Script for preventing the form resubmission dialog box.
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

// Script for sending the user to edit page to edit the address.
document.getElementsByClassName("edit-btn")[0].onclick = () => {
    window.location = "my_addressess.php?a=edit";
}

// Script for deleting the user's address and redirecting to the my addressess page.
document.getElementsByClassName("del-btn")[0].onclick = () => {
    window.location = "my_addressess.php?a=del";
}