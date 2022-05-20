<!-- Including the configration files. -->
<?php include "../../../includes/config/db.php"; ?>
<?php include "../../../includes/config/functions.php"; ?>
<?php include "../assets/functions.php"; ?>

<?php
/* Code for getting the pages for categories page. */
if (isset($_POST['a'])) {
    switch (escape($_POST['a'])) {
        default:
        // Setting the container and table head of the page.
            // Number of products in various categories.
            $wm_num = get_pros_incat("women");
            $mn_num = get_pros_incat("men");
            $fw_num = get_pros_incat("footwear");
            $ew_num = get_pros_incat("eyewear");

            $cont = <<<DELIMETER
            <main class="main-banners flex column">
                <div class="banner-group grid">
                    <h3 class="col-black container-head bg-white">Statistics</h3>
                    <div class="banner flex column bg-white">
                        <div class="banner-head flex row jc-space-bet">
                            <h4 class="col-black">{$wm_num}</h4>
                            <svg class="fill-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        </div>
                        <h4 class="banner-text col-black">Women Products</h4>
                        <div class="banner-bot flex row jc-space-bet" id="ord_all">
                            <h4>View More</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6l-128 128c-12.51 12.51-32.76 12.49-45.25 0c-12.5-12.5-12.5-32.75 0-45.25L402.8 288H32C14.31 288 0 273.7 0 255.1S14.31 224 32 224h370.8l-73.38-73.38c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l128 128C515.1 245.9 515.1 266.1 502.6 278.6z"/></svg>
                        </div>
                    </div>
                    <div class="banner flex column bg-white">
                        <div class="banner-head flex row jc-space-bet">
                            <h4 class="col-black">{$mn_num}</h4>
                            <svg class="fill-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        </div>
                        <h4 class="banner-text col-black">Men Products</h4>
                        <div class="banner-bot flex row jc-space-bet" id="ord_all">
                            <h4>View More</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6l-128 128c-12.51 12.51-32.76 12.49-45.25 0c-12.5-12.5-12.5-32.75 0-45.25L402.8 288H32C14.31 288 0 273.7 0 255.1S14.31 224 32 224h370.8l-73.38-73.38c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l128 128C515.1 245.9 515.1 266.1 502.6 278.6z"/></svg>
                        </div>
                    </div>
                    <div class="banner flex column bg-white">
                        <div class="banner-head flex row jc-space-bet">
                            <h4 class="col-black">{$ew_num}</h4>
                            <svg class="fill-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        </div>
                        <h4 class="banner-text col-black">Eyewears</h4>
                        <div class="banner-bot flex row jc-space-bet" id="ord_all">
                            <h4>View More</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6l-128 128c-12.51 12.51-32.76 12.49-45.25 0c-12.5-12.5-12.5-32.75 0-45.25L402.8 288H32C14.31 288 0 273.7 0 255.1S14.31 224 32 224h370.8l-73.38-73.38c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l128 128C515.1 245.9 515.1 266.1 502.6 278.6z"/></svg>
                        </div>
                    </div>
                    <div class="banner flex column bg-white">
                        <div class="banner-head flex row jc-space-bet">
                            <h4 class="col-black">{$fw_num}</h4>
                            <svg class="fill-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        </div>
                        <h4 class="banner-text col-black">Footwears</h4>
                        <div class="banner-bot flex row jc-space-bet" id="ord_all">
                            <h4>View More</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6l-128 128c-12.51 12.51-32.76 12.49-45.25 0c-12.5-12.5-12.5-32.75 0-45.25L402.8 288H32C14.31 288 0 273.7 0 255.1S14.31 224 32 224h370.8l-73.38-73.38c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l128 128C515.1 245.9 515.1 266.1 502.6 278.6z"/></svg>
                        </div>
                    </div>
                </div>
            </main>
            <main class="table-container bg-white">
                <h3 class="col-black container-head">Categories</h3>
                <table class="table bg-white">
                    <thead>
                        <tr class="all-col-black">
                            <th><input type="checkbox" id="all_check"></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th colspan="2">Options</th>
                        </tr>
                    </thead>
                    <tbody>
            DELIMETER;

            // Concatenating the rows with categories.
            $query = query("SELECT * FROM categories ");
            confirmQuery($query);

            while ($row = mysqli_fetch_assoc($query)) {
                $cont .= <<<DELIMETER
                <tr class="all-col-black cat_{$row['cat_id']}">
                    <th><input class="table_check" type="checkbox" name="check[]" value="{$row['cat_id']}"></th>
                    <th>{$row['cat_id']}</th>
                    <th>{$row['cat_name']}</th>
                    <th><button>Edit</button></th>
                    <th><button class="del-btn">Delete</button></th>
                </tr>
                DELIMETER;
            }

            // Concatenating the table bottom and form for adding a category.
            $cont .= <<<DELIMETER
                </tbody>
                </table>
                <div class="bg-black table-bottom flex row ai-center">
                    <select name="bulk_option" id="">
                        <option value="">Select an option...</option>
                        <option value="del-cats">Delete</option>
                    </select>
                    <button id="bulk-action-btn">Action</button>
                </div>
                <main class="form flex column jc-center bg-white">
                    <h3 class="container-head col-black">Add Category</h3>
                    <div id="add-cat">
                        <div class="form-group flex column jc-center">
                            <label for="name">Name</label>
                            <input type="text" id="cat-name">
                        </div>
                        <div class="form-group">
                            <button id="add-cat-btn">Add Category</button>
                        </div>
                    </div>
                </main>
            </main>
            DELIMETER;

            echo $cont;
            break;
    }
}
?>