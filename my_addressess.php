<?php include("includes/assets/html-header.php"); displayTitle("My Addressess"); ?>
<?php if (!isset($_SESSION['user_code'])) redirect("login.php"); ?>
<body>
    <!-- Loader - disappears on the load of page -->
    <?php include("includes/assets/loader.php"); ?>

    <!-- Addressess page -->
    <section class="page-content">
        <!-- The navbar -->
        <?php include("includes/assets/navbar-sl.php"); nav("My Addressess"); ?>

        <!-- My addressess page content. -->
        <section class="addressess">
            <?php
            // Code for displaying all the addresses and a edit address page.
            if (isset($_GET['a'])) {
                switch ($_GET['a']) {
                    case 'edit': // Including the edit address page.
                        include("includes/address/edit_add.php");
                        break;
                        
                    case 'add': // Including the add an address page.
                        include("includes/address/add_add.php");
                        break;

                    case 'del':
                        $query = query("DELETE FROM addressess WHERE user_code = '{$_SESSION['user_code']}' ");
                        confirmQuery($query);

                        redirect("my_addressess.php?a=show");
                        break;
                    
                    default: // Including the show all addressess page.
                        include("includes/address/show_add.php");
                        break;
                }
            }
            else {
                // Showing all the addressess by default.
                include("includes/address/show_add.php");
            }
            ?>
        </section>
    </section>
</body>
<script>
    const p = "m";
    const st = "<?php echo isset($state) ? $state : ""; ?>";
</script>
<script src="js/address.js"></script>
</html>