<?php
$query = query("SELECT * FROM addressess INNER JOIN users ON addressess.user_code = users.user_code WHERE users.user_code = '{$_SESSION['user_code']}' ");
confirmQuery($query);

if (mysqli_num_rows($query) != 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        echo <<<DELIMETER
        <address>
            <h3>{$row['user_full_name']}</h3>
            <p>{$row['house_num']}, {$row['road_name']}, {$row['landmark']}</p>
            <p>{$row['city']}, {$row['state']} - {$row['pincode']}</p>
            <h4>{$row['user_phnum']}</h4>
            <div class="address-btn">
                <button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i> EDIT</button>
                <button class="del-btn">REMOVE</button>
            </div>
        </address>
        DELIMETER;
    }
} else {
    echo <<<DELIMETER
    <main class="mess">
        <h3>You haven't registered your address yet!</h3>
        <img src="img/no-address.jpg" width="100px" alt="Ordered Succesfully!">
        <a class="a-link" href="my_addressess.php?a=add">Add Address</a>
    </main>
    DELIMETER;
}
?>