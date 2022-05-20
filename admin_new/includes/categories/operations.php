<!-- Including the configration files. -->
<?php include "../../../includes/config/db.php"; ?>
<?php include "../../../includes/config/functions.php"; ?>

<?php
/* Code for deleting a category from the database. */
if (isset($_POST['a'])) {
    switch ($_POST['a']) {
        case 'add_cat':
            $cn = escape($_POST['cn']);
            $query = query("INSERT INTO `categories`(`cat_name`) VALUES ('{$cn}')");
            confirmQuery($query);
            break;
        case 'del_cat':
            $cid = escape($_POST['did']);
            $query = query("DELETE FROM categories WHERE cat_id = '{$cid}' ");
            confirmQuery($query);
            break;
        case 'bulk_del_cats':
            $bcis = $_POST['bcis'];
            for ($i=0; $i < count($bcis); $i++) {
                $v = escape($bcis[$i]);
                $query = query("DELETE FROM categories WHERE cat_id = '{$v}' ");
                confirmQuery($query);
            }
            break;
    }
}
?>