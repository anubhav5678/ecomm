<!-- Including the configration files. -->
<?php include "../../../includes/config/db.php"; ?>
<?php include "../../../includes/config/functions.php"; ?>

<?php
if (isset($_POST['a'])) {
    switch (escape($_POST['a'])) {
        case 'ord_ord':
            $odid = escape($_POST['ord_id']);
            $query = query("UPDATE orders SET order_action = 'ordered' WHERE order_id = '{$odid}' ");
            confirmQuery($query);
            break;

        case 'ord_del':
            $odid = escape($_POST['ord_id']);
            $query = query("UPDATE orders SET order_user_status = 'delivered', order_action = 'delivered', order_delivery_date = NOW() WHERE order_id = '{$odid}' ");
            confirmQuery($query);
            break;

        case 'ord_can':
            $odid = escape($_POST['ord_id']);
            $query = query("UPDATE orders SET order_action = 'cancelled' WHERE order_id = '{$odid}' ");
            confirmQuery($query);
            break;

        case 'ord_ret':
            $odid = escape($_POST['ord_id']);
            $query = query("UPDATE orders SET order_action = 'returned' WHERE order_id = '{$odid}' ");
            confirmQuery($query);
            break;

        case 'bulk_ord':
            $bda = $_POST['bulk_data'];
            for ($i=0; $i < count($bda); $i++) { 
                $v = escape($bda[$i]);
                $query = query("UPDATE orders SET order_action = 'ordered' WHERE order_id = '{$v}' ");
                confirmQuery($query);
            }
            break;

        case 'bulk_can':
            $bda = $_POST['bulk_data'];
            for ($i=0; $i < count($bda); $i++) { 
                $v = escape($bda[$i]);
                $query = query("UPDATE orders SET order_action = 'cancelled' WHERE order_id = '{$v}' ");
                confirmQuery($query);
            }
            break;

        case 'bulk_del':
            $bda = $_POST['bulk_data'];
            for ($i=0; $i < count($bda); $i++) { 
                $v = escape($bda[$i]);
                $query = query("UPDATE orders SET order_user_status = 'delivered', order_action = 'delivered', order_delivery_date = NOW() WHERE order_id = '{$v}' ");
                confirmQuery($query);
            }
            break;

        case 'bulk_ret':
            $bda = $_POST['bulk_data'];
            for ($i=0; $i < count($bda); $i++) { 
                $v = escape($bda[$i]);
                $query = query("UPDATE orders SET order_action = 'returned' WHERE order_id = '{$v}' ");
                confirmQuery($query);
            }
            break;
    }
}
?>