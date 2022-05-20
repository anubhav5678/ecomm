// Script for highlighting the bottom of the category selected on the navbar.
var cats = document.querySelector('*[class="categories"]');
for (let i = 1; i <= cats.childNodes[1].childNodes.length - 2; i++) {
    if (cats.childNodes[1].childNodes[i].childNodes[1].innerText.toLowerCase() == ct) {
        cats.childNodes[1].childNodes[i].childNodes[1].setAttribute("class", "selected");
    }
}