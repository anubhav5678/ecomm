// Script for showing a loader when the page loads.
$(document).ready(function() {
    $("#loader").css("display", "none");
});

/* Script for redirecting the user on previous 
page on clicking the back arrow button. */
document.getElementById("back-btn").onclick = () => {
    window.history.back();
}

// Script for highlighting the link in the orders page.
var ls = document.querySelectorAll(".order-header a");
ls[l].classList += "selected";

/* Script for sending the return or cancel
request when a button of order is clicked. */
var bs = document.getElementsByTagName("button"); // Selecting the cancel/returns button.
var pu = document.getElementsByClassName("order-confirm")[0]; // Selecting the confirmation popup.
var puh = document.querySelector(".order-popup h3"); // Selecting the confirmation popup heading.
var c = "";

for (let i = 0; i < bs.length; i++) {
    bs[i].onclick = () => {
        window.scrollTo(0, 0);
        pu.style.display = "flex"; // Displaying the popup.
        document.body.style.overflow = "hidden"; // Stopping the scrolling of the page
        c = bs[i].parentNode.classList[0].slice(6); // Setting the order id of order.
        
        // Getting the action on a order.
        switch (bs[i].classList[0]) {
            // Event when an order is to be returned.
            case "return":
                puh.innerText = "Do you really want to return this product?";

                // Event on clicking cancel button.
                document.getElementById("cancel").onclick = () => {
                    document.body.style.overflow = ""; // Starting the scrolling of the page.
                    pu.style.display = "none"; // Hiding the popup.
                }
                // Event on clicking ok button.
                document.getElementById("ok").onclick = () => {
                    // Sending the order code to be returned.
                    window.location.href = "my_orders.php?a=retpro&c=" + c;
                }
                break;

            // Event when an order is to be cancelled.
            case "cancel":
                puh.innerText = "Do you really want to cancel this order?";

                // Event on clicking cancel button.
                document.getElementById("cancel").onclick = () => {
                    document.body.style.overflow = ""; // Starting the scrolling of the page.
                    pu.style.display = "none"; // Hiding the popup.
                }
                // Event on clicking ok button.
                document.getElementById("ok").onclick = () => {
                    $.post("includes/orders/orders_func.php", {"a" : "cancel", "c" : c},
                        function () {
                            window.location.reload();
                        }
                    );
                }
                break;
        }
    }
}

// Script for disabling/enabling continue button on the return product page.
if (window.location.href.includes("retpro")) {
    setInterval(() => { /* Checks every half second the values of reason and comments. */
        var re = document.getElementById("reason").value; // Reason input.
        var co = document.getElementById("comment").value; // Comment input.
        var an = document.getElementsByName("acc_num")[0].value;
        var rb = document.getElementsByName("return_product")[0]; // Submit button.
        // Enables/disables the continue button.
        if (re == "" || co == "" || an == "" || an.length < 11 || an.length > 18) {
            rb.disabled = true;
        } else {
            rb.disabled = false;
        }
    }, 500)
}

// Script for optimizing the page for returning single product.
if (window.location.href.includes("retpro")) {
    document.getElementsByClassName("order-header")[0].style.display = "none";
    document.querySelector("#nav-sl h3").innerText = "Return Product";

    var g = document.getElementById
}