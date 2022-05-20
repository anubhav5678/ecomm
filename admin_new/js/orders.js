/* Script for querying the products in bulk. */
var bo = document.querySelector("select[name='bulk_option']");
var ba = document.querySelector("button#bulk-action-btn");

if (bo != null && ba != null) {
    bo.onchange = () => {
        ba.style.display = "block";
        switch (bo.value) {
            case "ord-orders":
                ba.innerText = "Order";
                break;
            case "can-orders":
                ba.innerText = "Cancel";
                break;
            case "del-orders":
                ba.innerText = "Deliver";
                break;
            case "ret-orders":
                ba.innerText = "Return";
                break;
        }
    }
    ba.onclick = () => {
        console.log(sessionStorage['currentPage']);
        var cch = document.querySelectorAll("input[type='checkbox'].table_check:checked");
        var ccv = [];
        for (let i = 0; i < cch.length; i++) {
            ccv.push(cch[i].value);
        }
        console.log(ccv);
        switch (bo.value) {
            case 'ord-orders':
                $.post("includes/orders/operations.php", {"a" : "bulk_ord", "bulk_data" : ccv},
                    () => {
                        getContent("orders", "orders.js", "to_ord");
                    }
                );
                break;
    
            case 'del-orders':
                $.post("includes/orders/operations.php", {"a" : "bulk_del", "bulk_data" : ccv},
                    () => {
                        getContent("orders", "orders.js", "to_del");
                    }
                );
                break;

            case 'can-orders':
                $.post("includes/orders/operations.php", {"a" : "bulk_can", "bulk_data" : ccv},
                    () => {
                        getContent("orders", "orders.js", "to_can");
                    }
                );
                break;

            case 'ret-orders':
                $.post("includes/orders/operations.php", {"a" : "bulk_ret", "bulk_data" : ccv},
                    () => {
                        getContent("orders", "orders.js", "to_ret");
                    }
                );
                break;
        }
    }
}

/* Script for operations of a single product with its button in its row. */
var opBtn = document.querySelectorAll("button[class^='opr-btn-']");

for (let l = 0; l < opBtn.length; l++) {
    opBtn[l].onclick = () => {
        opBtn[l].parentNode.parentNode.style.transform = "translateX(2000px)";
        setTimeout(() => {
            opBtn[l].parentNode.parentNode.style.display = "none";
        }, 500);

        var act = opBtn[l].classList[0].slice(8);
        var did = opBtn[l].parentNode.parentNode.classList[1].slice(4);

        switch (act) {
            case 'ord':
                $.post("includes/orders/operations.php", {"a" : "ord_ord", "ord_id" : did});
                break;
            case 'ret':
                $.post("includes/orders/operations.php", {"a" : "ord_ret", "ord_id" : did});
                break;
            case 'can':
                $.post("includes/orders/operations.php", {"a" : "ord_can", "ord_id" : did});
                break;
            case 'del':
                $.post("includes/orders/operations.php", {"a" : "ord_del", "ord_id" : did});
                break;
        }
    } 
}