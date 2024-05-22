<?php
session_start();
require "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Agriculture Market : Orders</title>
    <link rel="stylesheet" href="./styles/w3.css">
</head>

<body>
    <div class="w3-container w3-padding">
        <div class="w3-container w3-pink">
            <h1>Orders</h1>
            <div class="w3-bar w3-margin-bottom">
                <a href="addorders.php" class="w3-bar-item w3-button w3-hover-pale-red">Add Orders</a>
                <?php
                $user = $_SESSION['user'];
                echo "<span class=\"w3-bar-item w3-right\">{$user}</span>";
                ?>
                <a href=" logout.php" class="w3-bar-item w3-button w3-pink w3-hover-pale-red w3-right">Sign Out</a>
            </div>
        </div>
        <div>
            <table class="w3-table w3-margin-top w3-striped w3-margin-bottom">
                <tr class="w3-pink">
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Sold By</th>
                </tr>
                <?php

                $query = "SELECT orders.OrderName, orders.Price, orders.Quantity, orders.Total, users.UserName FROM orders INNER JOIN users ON orders.UserID = users.ID WHERE users.UserType = 'farmer'";
                $result = mysqli_query($conn, $query);

                if ($result) {

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<tr><td>{$row['OrderName']}</td>" . "<td>{$row['Price']}</td>" . "<td>{$row['Quantity']}</td>" . "<td>{$row['Total']}</td>" . "<td>{$row['UserName']}</td></tr>";
                        }
                    } else {
                        echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>You have No Orders!</p></div>";
                    }
                }

                ?>
            </table>
        </div>

    </div>

</body>

</html>