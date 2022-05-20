// Script for logging user in.
var loader = '<div class="spinner-container" id="loader" style="width: 100%;"><div class="pulse-container"><div class="pulse-bubble pulse-bubble-1"></div><div class="pulse-bubble pulse-bubble-2"></div><div class="pulse-bubble pulse-bubble-3"></div></div></div>';

document.getElementById("login-btn").onclick = () => {
    var u = document.getElementById("user").value;
    var p = document.getElementById("pass").value;

    if (u.length != 0 && p.length != 0) {
        document.getElementById("login-btn").innerHTML = loader;
        
        $.post("includes/user/login_func.php", {"u" : u, "p" : p},
        function (response) {
            if (response == 0) {
                document.getElementById("login-btn").innerHTML = "Login";
                document.getElementById("err").innerHTML = "The email/phone number or password is incorrect.";
                } else {
                    window.location.reload();
                }
            }
        );
    } else {
        document.getElementById("err").innerHTML = "All fields must be filled.";
    }
}

// Script for adding a product to the cart.
var radioBtns = document.querySelectorAll('input[name^="product_size"]'); // Getting all the buttons of product size.

// Script for checking that the user is using mobile or desktop.
var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
var mach = "";
var bot = "";
if (isMobile) { // Setting the bottom attribute for the warning.
    mach = "M";
    bot = "0%";
} else {
    mach = "D";
    bot = "-10%";
}

// Script for adding a product into the cart of a user.
document.querySelector('button[id="add_to_cart"]').onclick = () => {
    if (u.length != 0) {
        // Checking that size of a product is selected.
        for (let i = 0; i < radioBtns.length; i++) {
            if (radioBtns[i].checked == true) {
                let size = radioBtns[i].value;
    
                // Showing up the product's warning - product added to cart.
                warningToggle("10%", '<h4>Product has been added to cart.</h4><a href="cart.php">View Cart</a>');
    
                $.post("includes/other/cart_func.php", {"action" : "addToCart", "code" : c, "size" : size},
                    function () {
                        // Setting a timeout to hide the product's warning after 3 seconds.
                        setTimeout(() => {
                            warningToggle(bot, "");
                        }, 3000);
                        
                        // Showing the number of products in cart of a user on navbar.
                        getCartNum();
                    }
                );
                break; // Breaking out of the loop when a size button is checked.
            } else {
                warningToggle("10%", "<h4>Please select the size of product.</h4>");
    
                // Setting a timeout to hide the product's warning after 3 seconds.
                setTimeout(() => {
                    warningToggle(bot, "");
                }, 3000);
            }
        }
    } else {
        document.querySelector('main[class="product-form"]').style.bottom = "0%";
    }
}

// Script when the buy now button is clicked.
document.querySelector('button[id="buy_product"]').onclick = () => {
    if (u.length != 0) {
        // Checking that size of a product is selected.
        for (let i = 0; i < radioBtns.length; i++) {
            if (radioBtns[i].checked == true) {
                warningToggle(bot); // Keeping the warning down.
                document.getElementById("size_form").submit();
            } else {
                // Bringing the warning up.
                warningToggle("10%", "<h4>Please select the size of product.</h4>");
    
                // Setting a timeout to hide the product's warning after 3 seconds.
                setTimeout(() => {
                    warningToggle(bot);
                }, 3000);
            }
        }
    } else {
        document.querySelector('main[class="product-form"]').style.bottom = "0%";
    }
}

// Script for sending the product code for adding it to the wishlist.
var h = document.querySelector('*[class=heart]');
if (h != null) {
    h.onclick = () => {
        // Getting the class of heart image.
        var w = h.childNodes[1];
        var a = w.getAttribute("class");
    
        // Adding or removing the product from wishlist.
        if (a == "far fa-heart") {
            w.setAttribute("class", "fas fa-heart");
            $.post("includes/other/wishlist_func.php", {"action" : "add", "code" : c});
        } else {
            w.setAttribute("class", "far fa-heart");
            $.post("includes/other/wishlist_func.php", {"action" : "remove", "code" : c});
        }
    }
}

// Script for displaying the delivery date of the product.
var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var mon = ["January","February","March","April","May","June","July","August","September","October","November","December"];

var d = new Date();
d.setDate(d.getDate() + 7);

document.querySelector('*[class="delivery"]').innerHTML = "Delivery by " + days[d.getDay()] + " " + d.getDate() + " " + mon[d.getMonth()] + " | <span class='discount'>Free</span>";

// Function for bringing the product's warning up and down.
function warningToggle (height="10%", mess="") {
    document.getElementsByClassName("product-warning")[0].style.bottom = height;
    document.getElementsByClassName("product-warning")[0].innerHTML = mess;
}