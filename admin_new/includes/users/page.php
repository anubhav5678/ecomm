<!-- Including the configration files. -->
<?php include "../../../includes/config/db.php"; ?>
<?php include "../../../includes/config/functions.php"; ?>

<?php
if (isset($_POST['a'])) {
    switch (escape($_POST['a'])) {
        case 'add':
            $cont = <<<DELIMETER
            <main class="form flex column jc-center bg-white">
                <h3 class="container-head col-black">Add User</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">User Full Name</label>
                        <input type="text" name="user_full_name">
                    </div>
                    <div class="form-group">
                        <label for="">User Phone Number</label>
                        <input type="number" name="user_phnum">
                    </div>
                    <div class="form-group">
                        <label for="">User Email</label>
                        <input type="email" name="user_email">
                    </div>
                    <div class="form-group flex column">
                        <label for="">User Role</label>
                        <select name="user_role">
                            <option value="">Select user role</option>
                            <option value="admin">Admin</option>
                            <option value="buyer">Buyer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="edit_user" value="Save">
                    </div>
                </form>
            </main>
            DELIMETER;

            echo $cont;
            break;
        
        default:
            $cont = <<<DELIMETER
            <main class="table-container bg-white">
                <h3 class="container-head col-black">Users</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="all-col-black">
                            <th>User ID</th>
                            <th>User Code</th>
                            <th>User Name</th>
                            <th>User Phone Number</th>
                            <th>User Email</th>
                            <th>User Role</th>
                            <th>Change User Role</th>
                            <th>Edit User</th>
                            <th>Delete User</th>
                        </tr>
                    </thead>
                    <tbody>
            DELIMETER;

            // Code for displaying all the users registered.
            $query = query("SELECT * FROM users ORDER BY user_id DESC ");
            confirmQuery($query);

            while ($row = mysqli_fetch_assoc($query)) {
                $cont .= <<<DELIMETER
                <tr class="all-col-black">
                    <th>{$row['user_id']}</th>
                    <th>{$row['user_code']}</th>
                    <th>{$row['user_full_name']}</th>
                    <th>{$row['user_phnum']}</th>
                    <th>{$row['user_email']}</th>
                    <th>{$row['user_role']}</th>
                    <th><a class="btn btn-primary" href="users.php?a=asa&uc={$row['user_code']}">Appoint as Admin</a></th>
                    <th><a class="btn btn-primary" href="users.php?a=eu&uc={$row['user_code']}">Edit</a></th>
                    <th><a class="btn btn-primary" href="users.php?a=du&uc={$row['user_code']}">Delete</a></th>
                </tr>
                DELIMETER;
            }
            $cont .= <<<DELIMETER
                        </tbody>
                </table>
            </main>
            DELIMETER;

            echo $cont;
            break;
    }
}
?>