/* Script for opening the specified pages when the buttons in banner are clicked. */
var bots = document.querySelectorAll("div.banner-bot");

for (let i = 0; i < bots.length; i++) {
    bots[i].onclick = () => {
        var id = bots[i].getAttribute("id");
        sessionStorage.setItem("currentPage", id);
        var pg = id.slice(0, 3);
        var at = id.slice(4, 7);

        switch (pg) {
            case "cat":
                getContent("categories", "cats.js", at);
                break;

            case "pro":
                getContent("products", "pros.js", at);
                break;
                
            case "usr":
                getContent("users", "users.js", at);
                break;

            case "ord":
                getContent("orders", "orders.js", at);
                break;
        }
    }
}