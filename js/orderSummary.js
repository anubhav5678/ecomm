/* Script for displaying the price details of the product(s)
on the basis of cart purchase or single purchase. */
if (o == "cart") {
    getPriceDetails();
}
else {
    getSinglePrice();
}

// Script for checking that the user is using mobile or desktop.
var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
var mach = "";
if (isMobile) {
    mach = "M";
} else {
    mach = "D";
}

// Script for highlighting the radio buttons payment methods on click.
var radioBtns = document.querySelectorAll('input[type="radio"]'); // Selecting the radio buttons.
var labels = document.querySelectorAll('label.input'); // Selecting the labels of the button.

// Highlighting label when radio button is clicked.
for (let k = 0; k < radioBtns.length; k++) {
    radioBtns[k].onclick = () => {
        for (let i = 0; i < radioBtns.length; i++) {
            if (radioBtns[i].checked == true) {
                radioBtns[i].style.color = "var(--points-color)";
                labels[i].style["border-width"] = "2px";
                labels[i].style["border-color"] = "var(--points-color)";
                labels[i].style["box-shadow"] = "0px 0px 20px 4px #8888883b";
                for (let j = 0; j < labels.length; j++) {
                    if (j == i) {
                        continue;
                    }
                    else {
                        labels[j].style["border-width"] = "1.5px";
                        labels[j].style["box-shadow"] = "";
                        labels[j].style["border-color"] = "var(--border-color)";   
                    }
                }
            }
        }
    }
}

// Function for submiting the form when continue button is clicked.
var btns = document.getElementsByClassName("continue-btn");
if (mach == "D") {
    bot = "-10%";
} else {
    bot = "0%";
}
for (let i = 0; i < btns.length; i++) {
    // Checking that the payment method is selected or not.
    btns[i].onclick = () => {
        for (let j = 0; j < radioBtns.length; j++) {
            if (radioBtns[j].checked == true) {
                // Processing the purchase if payment method is selected.
                document.getElementById("buy_product").submit();
                document.getElementsByClassName("product-warning")[0].style.bottom = bot;
                document.getElementsByClassName("product-warning")[0].innerHTML = "";
            }
            else {
                // Popping out a warning if payment isn't selected.
                document.getElementsByClassName("product-warning")[0].style.bottom = "10%";
                document.getElementsByClassName("product-warning")[0].innerHTML = "<h4>Please select the payment method.</h4>";
                window.scrollTo(0,document.body.scrollHeight);
                // Setting a timeout to hide the product's warning after 3 seconds.
                setTimeout(() => {
                    document.getElementsByClassName("product-warning")[0].style.bottom = bot;
                    document.getElementsByClassName("product-warning")[0].innerHTML = "";
                }, 3000);
            }
        }
    }
}

// Function for displaying the total price, discount and amount in the cart of a user.
function getPriceDetails() {
    $.post("includes/other/cart_func.php", {"action" : "getPriceDetails"},
    function (response) {
        var priceDetails = JSON.parse(response);
        // Putting the number of products in product details with item and items.
        if (parseInt(priceDetails["total_products"]) == 1) {
            document.getElementById("product-quantity").innerText = "Price(" + parseInt(priceDetails["total_products"]) + " item)";
        } else {
            document.getElementById("product-quantity").innerText = "Price(" + parseInt(priceDetails["total_products"]) + " items)";
        }

        // Putting the total price, discount and delivery charge into price details section.
        document.getElementById("delivery-charge").innerText = "Free";
        document.getElementById("total-price").innerText = "₹" + parseFloat(priceDetails["total_price"]);
        document.getElementById("total-discount").innerText = "- ₹" + parseFloat(priceDetails["total_discount"]);
        document.querySelector('h5[class="discount"]').innerText = "You Save ₹" + parseFloat(priceDetails["total_discount"]) + " on this order.";
        var totAmounts = document.getElementsByClassName("total-amount");
        for (let i = 0; i < totAmounts.length; i++) {
            totAmounts[i].innerText = "₹" + parseFloat(priceDetails["total_amount"]);
        }
    });
}

// Function for getting the the price detail of a single product to buy.
function getSinglePrice () {
    $.post("includes/other/cart_func.php", {"action" : "getSinglePrice", "code" : c},
        function (response) {
            var priceDetails = JSON.parse(response);

            // Displaying the price details of product in price details.
            document.getElementById("delivery-charge").innerText = "Free";
            document.getElementById("product-quantity").innerText = "Price(1 item)";
            document.getElementById("total-discount").innerText = "- ₹" + (parseFloat(priceDetails.price) - parseFloat(priceDetails.amount));
            document.getElementById("total-price").innerText = "₹" + parseFloat(priceDetails.price);
            document.querySelector('h5[class="discount"]').innerText = "You Save ₹" + (parseFloat(priceDetails.price) - parseFloat(priceDetails.amount)) + " on this order.";
            var totAmounts = document.getElementsByClassName("total-amount");
            for (let i = 0; i < totAmounts.length; i++) {
                totAmounts[i].innerText = "₹" + parseFloat(priceDetails.amount);
            }
        }
    );
}

// Script for displaying the delivery date of the product.
var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var mon = ["January","February","March","April","May","June","July","August","September","October","November","December"];

var d = new Date();
d.setDate(d.getDate() + 7);

var del = document.querySelectorAll('*[class="delivery"]');

for (let i = 0; i < del.length; i++) {
    del[i].innerHTML = "Delivery by " + days[d.getDay()] + " " + d.getDate() + " " + mon[d.getMonth()] + " | <span class='discount'>Free</span>";
}

// Script for preventing the form resubmission dialog box.
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

/* Script for redirecting the user on previous 
page on clicking the back arrow button. */
document.getElementById("back-btn").onclick = () => {
    window.history.back();
}

// Script for showing a loader when the page loads.
$(document).ready(function() {
    $("#loader").css("display", "none");
});