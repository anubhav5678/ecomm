/* Script for making the making the the sidebar in and out. */
var sd = document.querySelector(".sidebar"); // Sidebar.
var hb = document.querySelector("#ham-btn"); // Hamburger Button.
var cb = document.querySelector("#close-btn"); // Close Sidebar Button.

hb.onclick = () => { // Bringing the sidebar in when hamburger button is clicked.
    sd.style.left = "0";
    sd.style["box-shadow"] = "-2px 0px 20px 0px #a8afbd";
}
cb.onclick = () => { // Taking the sidebar out when close button is clicked.
    sd.style.left = "-70%";
    sd.style["box-shadow"] = "none";
}

/* Script for opening and closing a dropdown menu. */
var ddmh = document.querySelectorAll("h3.side-heading"); // Getting all the dropdown buttons.
var ddm = document.querySelectorAll("main.side-control"); // Getting all the dropdown menus.

// Iterating through the dropdown buttons and opening the respective menu on click.
for (let i = 0; i < ddmh.length; i++) {
    ddmh[i].onclick = () => {
        // Checking that the dropdown menu is opened or closed.
        if (ddm[i + 1].style.display == "flex") {
            ddm[i + 1].style.display = "none"; // Closing the dropdown menu.
            // Rotating the dropdown button at its original position when menu is closed.
            ddmh[i].querySelector("svg").style.transform = "rotate(0deg)";
        } else {
            ddm[i + 1].style.display = "flex"; // Opening the dropdown menu.
            // Rotating the dropdown button upwards when menu is open.
            ddmh[i].querySelector("svg").style.transform = "rotate(180deg)";
        }
    }
}

/* Function for adding the page content got from server into the main container of the page. */
function getContent (path, src, page, adt="") {
    $.post(`includes/${path}/page.php`, {"a" : page, "adt_info" : adt},
        (response) => {
            document.querySelector("article.main-content").innerHTML = response;

            for (let i = 0; i < 2; i++) {
                var sct1 = document.querySelectorAll("script")[3];
                if (sct1 != null || sct1 != undefined) {
                    sct1.remove();
                }
            }

            var bod = document.getElementsByTagName("html")[0];
            var scp1 = document.createElement("script");
            var scp2 = document.createElement("script");
            scp1.src = `js/${src}`;
            scp2.src = "js/functions.js";
            bod.appendChild(scp1);
            bod.appendChild(scp2);
        }
    );
}