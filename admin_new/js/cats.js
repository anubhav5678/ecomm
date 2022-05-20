/* Script for deleting the categories in bulk. */
var bo = document.querySelector("select[name='bulk_option']");
var ba = document.querySelector("#bulk-action-btn");

bo.onchange = () => {
    ba.style.display = "block";
    switch (bo.value) {
        case "del-cats":
            ba.innerText = "Delete";
            break;
    }
}
ba.onclick = () => {
    var cch = document.querySelectorAll("input[type='checkbox'].table_check:checked");
    var ccv = [];
    for (let i = 0; i < cch.length; i++) {
        ccv.push(cch[i].value);
    }
    $.post("includes/categories/operations.php", {"a" : "bulk_del_cats", "bcis" : ccv},
        () => {
            setTimeout(() => {
                getContent("categories", "cats.js", "ft376tf");
            }, 1000);
        }
    );
}

/* Script for deleting a category from the database. */
var debn = document.querySelectorAll("th button.del-btn");

for (let i = 0; i < debn.length; i++) {
    debn[i].onclick = () => {
        debn[i].parentNode.parentNode.style.transform = "translateX(1000px)";
        setTimeout(() => {
            debn[i].parentNode.parentNode.style.display = "none";
        }, 500);

        var did = debn[i].parentNode.parentNode.classList[1].slice(4);
        $.post("includes/categories/operations.php", {"a" : "del_cat", "did" : did});
    }
}

/* Script for adding a category into the database. */
var act = document.querySelector("button#add-cat-btn");
act.onclick = () => {
    let acn = document.querySelector("input#cat-name").value;

    if (acn) {
        $.post("includes/categories/operations.php", {"a" : "add_cat", "cn" : acn});
        setTimeout(() => {
            getContent("categories", "cats.js", "6tr34");
        }, 1000)
    }
}