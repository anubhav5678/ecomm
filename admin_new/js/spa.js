/* Getting by default the dashboard page. */
getContent("dashboard", "dash.js", "fg67yu573");

/* Scripts for making the Web Application Single Page Application. */
var btns = document.querySelectorAll("div.side-btn");

for (let i = 0; i < btns.length; i++) {
    btns[i].onclick = () => {
        for (let j = 0; j < btns.length; j++) {
            btns[j].classList.remove("selected");
        }
        btns[i].classList.add("selected");

        var id = btns[i].getAttribute("id");
        sessionStorage.setItem("currentPage", id);
        var pg = id.slice(0, 3);
        var at = id.slice(4);

        switch (pg) {
            case "dsb":
                getContent("dashboard", "dash.js", at);
                break;

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