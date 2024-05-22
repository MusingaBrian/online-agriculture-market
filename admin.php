<?php
session_start();
require "database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/w3.css">
    <title>Online Agriculture Market : Admin Panel</title>
</head>

<body>
    <div class="w3-container w3-row w3-padding">
        <div class="w3-container w3-pink">
            <h1>Edit Users</h1>
            <div class="w3-bar w3-pink w3-margin-bottom">
                <?php
                $user = $_SESSION['user'];
                echo "<span class=\"w3-bar-item w3-right\">{$user}</span>";
                ?>
                <a href="logout.php" class="w3-bar-item w3-button w3-pink w3-hover-pale-red w3-right">Sign Out</a>
                <a href="home.php" class="w3-bar-item w3-button w3-hover-pale-red">Product</a>
                <a href="addproducts.php" class="w3-bar-item w3-button w3-hover-pale-red">Add Product</a>
                <a href="orders.php" class="w3-bar-item w3-button w3-hover-pale-red">Orders</a>
                <a href="addorders.php" class="w3-bar-item w3-button w3-hover-pale-red">Add Orders</a>
            </div>
        </div>

        <div>
            <table class="w3-table w3-margin-top w3-striped w3-margin-bottom">
                <tr class="w3-pink">
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                </tr>
                <?php

                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);

                if ($result) {

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            $id = $row['ID'];

                            echo "<tr><td>{$row['ID']}</td>" . "<td>{$row['UserName']}</td>" . "<td>{$row['Email']}</td>" . "<td>{$row['UserType']}</td></tr>";
                        }
                    } else {
                        echo "No Products Found!";
                    }
                }
                ?>
            </table>
        </div>

        <div>
            <?php

            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                if (empty($_POST['id'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter User Id.</p></div>";
                } elseif (empty($_POST['username'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter User Name.</p></div>";
                } elseif (empty($_POST['email'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter Email.</p></div>";
                } elseif (empty($_POST['usertype'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Select User Type.</p></div>";
                } else {

                    $userid = $_POST['id'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $usertype = $_POST['usertype'];


                    $query = "UPDATE users SET UserName = '$username', Email = '$email', UserType = '$usertype' WHERE ID = '$userid'";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        echo "<div class=\"w3-panel w3-pale-green w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Success!</h3><p>User Updated Successfully.</p></div>";
                    } else {
                        echo "Error: " . "<br>" . mysqli_error($conn);
                    }
                }
            }
            ?>
            <form action="admin.php" method="POST" class="w3-margin-top w3-margin-bottom">
                <label for="id">Enter User ID</label>
                <input type="number" name="id" class="w3-input w3-margin-bottom">
                <label for="username">Edit User Name</label>
                <input type="text" name="username" class="w3-input w3-margin-bottom">
                <label for="email">Edit User Email</label>
                <input type="text" name="email" class="w3-input w3-margin-bottom">
                <div class="w3-margin-bottom w3-margin-top">
                    <select name="usertype" class="w3-select">
                        <option value="" disabled selected>Select User type</option>
                        <option value="admin">Admin</option>
                        <option value="farmer">Farmer</option>
                        <option value="buyer">Buyer</option>
                    </select>
                </div>
                <button type="submit" class="w3-btn w3-pink w3-margin-top w3-hover-pale-red w3-margin-bottom">Update</button>
            </form>
        </div>
    </div>

</body>

</html>