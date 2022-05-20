/* Script for sending the the user at the individual product's
page when the user clicks on the product's image/details. */

// Script for selecting all the containers of a product's image.
var det = document.querySelectorAll('*[class^="product-details"]');
for (let i = 0; i < det.length; i++) {
    det[i].onclick = () => {
        // Script for sending the user at page of the product.
        location.href = "product.php?c=" + det[i].getAttribute("class").slice(16);
    }
}
// Script for selecting all the containers of a product's details.
var img = document.querySelectorAll('*[class^="product-img"]');
for (let i = 0; i < img.length; i++) {
    img[i].onclick = () => {
        // Script for sending the user at page of the product.
        location.href = "product.php?c=" + img[i].getAttribute("class").slice(12);
    }
}
/* ======================================== */

// Script for sending the product code for adding/removing it to the wishlist.
var h = document.querySelectorAll('*[class=heart]');
for (let i = 0; i < h.length; i++) {
    h[i].onclick = () => {
        // Getting the code of a product from the product's container.
        var c = h[i].parentNode.getAttribute("class").slice(8);

        // Getting the class of heart.
        var w = h[i].querySelector('i[class^="fa"]');
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