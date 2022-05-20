var ps = document.querySelectorAll('div[class^="cart-product"]');
var ins = document.querySelectorAll('input[class^="product_quantity_"]');
var warn = document.querySelectorAll('div[class^="warning_"]');

getPriceDetails(); // Calling the function for price details as the page loads.

/* Script for sending the product's code when a number is typed
in product's quantity input field to insert the product quantity. */
for (let i = 0; i < ins.length; i++) {
    ins[i].onkeypress = (e) => {
        if (e.keyCode == 13 || e.code == "Enter") {
            var b = getInfo(i)

            if (b[2] > 3) {
                warn[i].innerHTML = "You can't have more than 3 products.";
                $.post("includes/other/cart_func.php", {"action" : "editQuantity", "code" : b[0], "size" : b[1], "productQuantity" : 3},
                    function () {
                        getQuantity(b[0], b[1]);
                        getPriceDetails();
                    }
                );
            } else {
                if (b[2] >= 1) {
                    warn[i].innerHTML = "";
                    $.post("includes/other/cart_func.php", {"action" : "editQuantity", "code" : b[0], "size" : b[1], "productQuantity" : b[2]},
                        function () {
                            getQuantity(b[0], b[1]);
                            getPriceDetails();
                        }
                    );
                }
                else if (b[2] < 1) {
                    $.post("includes/other/cart_func.php", {"action" : "editQuantity", "code" : b[0], "size" : b[1], "productQuantity" : 1},
                        function () {
                            getQuantity(b[0], b[1]);
                            getPriceDetails();
                        }
                    );
                }
            }
        }
    }
}

// Script for sending the product code when a product's increment button is clicked.
var incre = document.querySelectorAll('button[class^="incre_"]');

for (let i = 0; i < incre.length; i++) {
    incre[i].onclick = () => {
        // Getting the product's code and size of the product in the cart whose quantity id to be incremented.
        const b = getInfo(i);

        if (b[2] == 3) {
            // Showing a warning if users increments over 3 products.
            warn[i].innerHTML = "You can't have more than 3 products.";
        }
        else {
            warn[i].innerHTML = "";
            $.post("includes/other/cart_func.php", {"action" : "increment", "code" : b[0], "size" : b[1]},
                function () {
                    getQuantity(b[0], b[1]);
                    getPriceDetails();
                }
            );
        }
    }
}

// Script for sending the product code when a product's decrement button is clicked.
var decre = document.querySelectorAll('button[class^="decre_"]');

for (let i = 0; i < decre.length; i++) {
    decre[i].onclick = () => {
        // Getting the product's code and size of the product in the cart whose quantity id to be incremented.
        const b = getInfo(i);
    
        warn[i].innerHTML = "";
        if (b[2] != 1) {
            $.post("includes/other/cart_func.php", {"action" : "decrement", "code" : b[0], "size" : b[1]},
                function () {
                    getQuantity(b[0], b[1]);
                    getPriceDetails();
                }
            );
        }
    }
}

/* Script for sending the product code and size when
a product's delete button is clicked and deleting it. */
var d = document.querySelectorAll('button[class^="del_"]');

for (let i = 0; i < d.length; i++) {
    d[i].onclick = () => {
        // Getting the product's code and size of the product in the cart to be deleted.
        var b = getInfo(i);

        // Sending request to the server.
        $.post("includes/other/cart_func.php", {"action" : "deleteProduct", "code" : b[0], "size" : b[1]},
            function (response) {
                console.log(response);
                if (response == "deleted") {
                    location.reload();
                }
            }
        );
    }
}

// Script for displaying the total price, discount and amount in the cart of a user.
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

// Function for getting the product's quantity with it's product code.
function getQuantity (code, size) {
    $.post("includes/other/cart_func.php", {"action" : "getQuantity", "code" : code, "size" : size},
        function (response) {
            document.getElementsByClassName("product_quantity_" + code + "_" + size)[0].value = response;
        }
    );
}

// Function for getting the product code from the class of the button.
function getInfo (n) {
    // Getting the info of the product - size, quantity and code.
    var info = ps[n].getAttribute("class").split(" ");

    var q = ps
    var code = info[1].slice(2);
    var size = info[2].slice(2);
    var quan = parseInt(ins[n].value);

    return [code, size, quan];
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