/* Script for removing a product from user's
wishlist when remove button is clicked. */
var r = document.querySelectorAll('button[id^="remove_"]');

for (let i = 0; i < r.length; i++) {
    r[i].onclick = () => {
        var c = r[i].getAttribute("id").slice(7)
        $.post("includes/other/wishlist_func.php", {"action" : "remove", "code" : c});
        location.reload();
    }
}