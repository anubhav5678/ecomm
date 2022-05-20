/* Script for querying the products in bulk. */
var bo = document.querySelector("select[name='bulk_option']");
var ba = document.querySelector("button#bulk-action-btn");
var cs = document.querySelector("select.chg-pros-cat");
var ii = document.querySelector("input[name='price-val']");

if (bo != null && ba != null) {
    bo.onchange = () => {
        ba.style.display = "block";
        switch (bo.value) {
            case "del-pros":
                cs.style.display = "none";
                ii.style.display = "none";
                ba.innerText = "Delete";
                break;
            case "chg-cat-pros":
                cs.style.display = "block";
                ii.style.display = "none";
                ba.innerText = "Change";
                break;
            case "decre-prc-pros":
                cs.style.display = "none";
                ii.style.display = "block";
                ba.innerText = "Decrease";
                break;
            case "incre-prc-pros":
                cs.style.display = "none";
                ii.style.display = "block";
                ba.innerText = "Increase";
                break;
        }
    }
    ba.onclick = () => {
        var cch = document.querySelectorAll("input[type='checkbox'].table_check:checked");
        var ccv = [];
        for (let i = 0; i < cch.length; i++) {
            ccv.push(cch[i].value);
        }
        switch (bo.value) {
            case "del-pros":
                var tScTp = document.querySelector("main.table-container").scrollTop;
                $.post("includes/products/operations.php", {"a" : "bulk_del_pros", "bcis" : ccv},
                    () => {
                        setTimeout(() => {
                            getContent("products", "pros.js", "bulk_del_pros");
                            setTimeout(() => {
                                document.querySelector("main.table-container").scrollTop = tScTp;
                            }, 100);
                        }, 1000);
                    }
                );
                break;

            case "chg-cat-pros":
                let nwCat = document.querySelector("select.chg-pros-cat").value;
                var tScTp = document.querySelector("main.table-container").scrollTop;

                $.post("includes/products/operations.php", {"a" : "bulk_chn_cats", "bcis" : ccv, "new_cat" : nwCat},
                    () => {
                        setTimeout(() => {
                            getContent("products", "pros.js", "fhg36gf");
                            setTimeout(() => {
                                document.querySelector("main.table-container").scrollTop = tScTp;
                            }, 100);
                        }, 1000);
                    }
                );
                break;

            case "decre-prc-pros":
                var deAmt = document.querySelector("input[name='price-val']").value;
                var tScTp = document.querySelector("main.table-container").scrollTop;

                $.post("includes/products/operations.php", {"a" : "bulk_decre_pros", "bcis" : ccv, "decre_amt" : deAmt},
                    () => {
                        setTimeout(() => {
                            getContent("products", "pros.js", "f3yg64");
                            setTimeout(() => {
                                document.querySelector("main.table-container").scrollTop = tScTp;
                            }, 100);
                        }, 1000);
                    }
                );
                break;

            case "incre-prc-pros":
                var inAmt = document.querySelector("input[name='price-val']").value;
                var tScTp = document.querySelector("main.table-container").scrollTop;

                $.post("includes/products/operations.php", {"a" : "bulk_incre_pros", "bcis" : ccv, "incre_amt" : inAmt},
                    () => {
                        setTimeout(() => {
                            getContent("products", "pros.js", "dr345d");
                            setTimeout(() => {
                                document.querySelector("main.table-container").scrollTop = tScTp;
                            }, 100);
                        }, 1000);
                    }
                );
                break;
        }
    }
}

/* Script for adding a product. */
var apb = document.querySelector("input[name='add_product']");

if (apb != null) {
    apb.onclick = () => {
        var pData = [];
        for (let i = 0; i <= 11; i++) {
            pData.push(document.getElementsByName(`p_${i}`)[0].value);
            document.getElementsByName(`p_${i}`)[0].value = "";
        }
        $.post("includes/products/operations.php", {"a" : "add_pro", "pro_data" : pData},
            (response) => {
                console.log(response);   
            }
        );
    }
}

/* Script for saving the details of a product when save button is clicked. */
var sbtn = document.querySelector("input[name='edit_product']");

if (sbtn != null) {
    sbtn.onclick = () => {
        var pData = [];
        for (let i = 0; i <= 11; i++) {
            pData.push(document.getElementsByName(`p_${i}`)[0].value);
            document.getElementsByName(`p_${i}`)[0].value = "";
        }

        $.post("includes/products/operations.php", {"a" : "edit_pro", "pro_data" : pData, "edit_id" : sessionStorage["edit_id"]},
            () => {
                getContent("products", "pros.js", "y543gfy4rt");
            }
        );
    }
}

/* Script for opening the edit a product page in the database. */
var debn = document.querySelectorAll("th button.edit-btn");

for (let i = 0; i < debn.length; i++) {
    debn[i].onclick = () => {
        var did = debn[i].parentNode.parentNode.classList[1].slice(4);
        sessionStorage.setItem("edit_id", did);
        getContent("products", "pros.js", "edit_pro", did)
    }
}

/* Script for deleting a product from the database. */
var debn = document.querySelectorAll("th button.del-btn");

for (let i = 0; i < debn.length; i++) {
    debn[i].onclick = () => {
        debn[i].parentNode.parentNode.style.transform = "translateX(2000px)";
        setTimeout(() => {
            debn[i].parentNode.parentNode.style.display = "none";
        }, 500);

        var did = debn[i].parentNode.parentNode.classList[1].slice(4);
        $.post("includes/products/operations.php", {"a" : "del_pro", "bcis" : did});
    }
}