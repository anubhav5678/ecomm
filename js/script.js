// Script for showing a loader when the page loads.
$(document).ready(function() {
    $("#loader").css("display", "none");
});

// Script for doing some tasks when page is loaded.
$(document).ready(function () {
    getCartNum();
});

/* Script for fixing the navbar at the top with
a background color when the page is scrolled. */
var nav = document.getElementsByTagName("header")[0];
var h = nav.offsetHeight;
var is = document.querySelectorAll(".options ul i");
var as = document.querySelectorAll(".categories ul a");

window.addEventListener('scroll', () => { // Event when the page is scrolled more than the height of navbar.
    if (window.scrollY > h) {
        nav.style["position"] = "fixed"; // Fixing navbar at top.
        nav.style["background-color"] = "var(--backdrop-color)"; // Setting the background color.

        // Changing the color of every a/i tags on mouse up and down.
        for (let i = 0; i < as.length; i++) {
            is[i].style.color = "#000"; // Changes color to black.
            as[i].style.color = "#000"; // Changes color to black.
            
            as[i].onmouseover = () => {
                // Changing color to accent color of a tag onmouseover.
                as[i].style.color = "var(--accent-color)";
            }
            is[i].onmouseover = () => {
                // Changing color to accent color of i tag onmouseover.
                if (is[i].getAttribute("class").split(" ")[1] == "fa-heart") {
                    // Changing color to red if i tag is a heart onmouseover.
                    is[i].style.color = "rgb(255, 0, 0)";
                } else {
                    is[i].style.color = "var(--accent-color)";
                }
            }

            // Changes color to black onmouseout.
            as[i].onmouseout = () => {
                as[i].style.color = "#000";
            }
            is[i].onmouseout = () => {
                is[i].style.color = "#000";
            }
        }
    } else {
        // Makes the navbar's position static when the page is scrolled to top.
        nav.style["position"] = "static";
        nav.style["background-color"] = "#fff";

        // Changes the color of a/i tags to default.
        for (let i = 0; i < as.length; i++) {
            is[i].style.color = "";
            as[i].style.color = "";
        }
    }
})

/* Function for getting the number of products in 
the cart of a user and displaying it on the navbar. */
function getCartNum () {
    $.post("includes/other/cart_func.php?", {"action" : "getCartNum"},
        function (response) {
            $("#cart-num").text(response);
        }
    );
}

// Script for preventing the form resubmission dialog box.
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// Script for preventing the context menu to pop when an image is right clicked.
var ims = document.getElementsByTagName("img");
for (let i = 0; i < ims.length; i++) {
    ims[i].addEventListener('contextmenu', e => {
        e.preventDefault();
    });
}

// Script for coloring the div's border in accent color and adding box-shadow when clicked.
let inputs = document.getElementsByClassName("input");

for (let i = 0; i < inputs.length; i++) {
    inputs[i].onclick = function () {
        this.style["border-color"] = "var(--accent-color)";
        this.style["box-shadow"] = "0px 0px 20px 0px #8888883b";
    }
}

// Selecting elements for functioning of sidebar.
let ham = document.getElementById("ham-btn");
let sidebar = document.getElementById("sidebar");
let close = document.getElementById("close-btn");


// Adding eventlistener for moving the sidebar on clicking hamburger button into the page.
ham.onclick = function () {
    // Function for eventlistener.
    sidebar.style.left = "0%";
    ham.style["z-index"] = "0";
    sidebar.style['box-shadow'] = "rgb(136 136 136 / 23%) 12px 0px 20px 15px";
}

// Adding eventlistener for moving out the sidebar on clicking the close button.
close.onclick = function () {
    // Function for eventlistener.
    sidebar.style['box-shadow'] = "";
    sidebar.style.left = "-75%";
}

// Hovering a popup panel when mouse is taken over to the accounts icon on Desktop.
let accIco = document.getElementById("account");
let popUp = document.getElementById("desk-account");

if (accIco != null) {
    accIco.onmouseover = function () {
        popUp.style.display = "block";
    }
    document.onclick = function () {
        popUp.style.display = "none";
    }
}

/* Script for getting the value of searchbar and showing product recommendations. */
// Script for coloring the searchbar's border in accent color when clicked.
var searchdiv = document.getElementById("search");
var suggests = document.getElementsByClassName("suggest")[0];

// Script for clearing the text in searchbar when clear button is clicked.
document.getElementById("search-clear").onclick = function () {
    document.getElementById("searchbar").value = "";
    suggests.style.display = "none";
}

/* Changing the style of searchbar and displaying suggestions
box when search input is in focus. */
searchdiv.onclick = () => {
    // Focusing on the searchbar when clicked.
    document.getElementById("searchbar").focus();
    // Changing the styles of searchbar when searchbar is clicked.
    searchdiv.style["box-shadow"] = "0px 0px 17px 1px #8888883b";
    searchdiv.style["border-color"] = "var(--accent-color)";

    // Requesting server for the recent searches of the user when searchbar is clicked for the first time.
    $.post("includes/other/get_product_suggestions.php", {"a" : "hist"},
        function (response) {
            // Suggestions box is hidden when there's no response.
            if (response.length == 0) {
                suggests.style.display = "none";
            }
            // Suggestions box appears when there's a response.
            else {
                suggests.style.display = "block";
                suggests.style["box-shadow"] = "0px 10px 17px 1px #8888883b";
                suggests.innerHTML = response;
            }
        }
    );

    // Requesting the server for some products when something is typed in the searchbar.
    searchdiv.onkeyup = () => {
        var search = document.getElementById("searchbar").value; // Value in the searchbar.
        $.post("includes/other/get_product_suggestions.php", {"a" : "search", "q" : search},
            function (response) {
                // Hiding the suggestions box when there's no response.
                if (response.length == 0 || response == 0) {
                    suggests.style.display = "none";
                } else {
                    // Displaying the suggestions when there's any response.
                    suggests.style.display = "block";
                    suggests.style["box-shadow"] = "0px 10px 17px 1px #8888883b";
                    suggests.innerHTML = response;
                }
            }
        );
    }
}