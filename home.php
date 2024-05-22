<?php
session_start();
require "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Agriculture Market : Products</title>
    <link rel="stylesheet" href="./styles/w3.css">
</head>

<body>
    <div class="w3-container w3-padding">
        <div class="w3-container w3-pink">
            <h1>Welcome to Online Agriculture Market</h1>
            <div class="w3-bar w3-pink w3-margin-bottom">

                <a href="logout.php" class="w3-bar-item w3-button w3-pink w3-hover-pale-red w3-right">Sign Out</a>
                <?php

                $query = "SELECT * FROM users WHERE UserName = '{$_SESSION['user']}'";
                $result = mysqli_query($conn, $query);

                if ($result) {

                    if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_assoc($result);

                        $usertype = $row['UserType'];
                        $user = $_SESSION['user'];
                        echo "<span class=\"w3-bar-item w3-right\">{$user}</span>";

                        switch ($usertype) {
                            case 'buyer':
                                echo "<a href=\"orders.php\" class=\"w3-bar-item w3-button w3-hover-pale-red\">Orders</a>";
                                echo "<a href=\"addorders.php\" class=\"w3-bar-item w3-button w3-hover-pale-red\">Add Orders</a>";
                                break;
                            case 'farmer':
                                echo "<a href=\"addproducts.php\" class=\"w3-bar-item w3-button w3-hover-pale-red\">Add Products</a>";
                                break;
                            case 'admin':
                                echo "<a href=\"admin.php\" class=\"w3-bar-item w3-button w3-hover-pale-red\">Edit User</a>";
                                echo "<a href=\"home.php\" class=\"w3-bar-item w3-button w3-hover-pale-red\">Product</a>";
                                echo "<a href=\"addproducts.php\" class=\"w3-bar-item w3-button w3-hover-pale-red\">Add Products</a>";
                                echo "<a href=\"orders.php\" class=\"w3-bar-item w3-button w3-hover-pale-red\">Orders</a>";
                                echo "<a href=\"addorders.php\" class=\"w3-bar-item w3-button w3-hover-pale-red\">Add Order</a>";
                                break;
                            default:
                                echo "Normal User";
                        }
                    } else {
                        echo "Something Wrong Happened!";
                    }
                }

                ?>
            </div>
        </div>
        <div>
            <table class="w3-table w3-margin-top w3-striped w3-margin-bottom">
                <tr class="w3-pink">
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Sold By</th>
                </tr>
                <?php

                $query = "SELECT products.ProductName, products.Price, users.UserName FROM products INNER JOIN users ON products.FarmerID = users.ID WHERE users.UserType = 'farmer'";
                $result = mysqli_query($conn, $query);

                if ($result) {

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<tr><td>{$row['ProductName']}</td>" . "<td>{$row['Price']}</td>" . "<td>{$row['UserName']}</td></tr>";
                        }
                    } else {
                        echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>No Products Found!</p></div>";
                    }
                }
                ?>
            </table>
        </div>

    </div>

</body>

</html>