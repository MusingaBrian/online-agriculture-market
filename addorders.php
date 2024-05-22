<?php
session_start();
require "database.php";
?>

<?php
$user = $_SESSION['user'];
if ($user) {
    $query = "SELECT users.ID, products.FarmerID FROM users INNER JOIN products ON users.ID = products.FarmerID";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $userId = $row['ID'];
            $farmerID = $row['FarmerID'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Agriculture Market : Add Orders</title>
    <link rel="stylesheet" href="./styles/w3.css">
</head>

<body>
    <div class="w3-container w3-padding">
        <div class="w3-container w3-pink">
            <h1>Add Orders</h1>
            <div class="w3-bar w3-margin-bottom">
                <?php
                $user = $_SESSION['user'];
                echo "<span class=\"w3-bar-item w3-right\">{$user}</span>";
                ?>
                <a href="orders.php" class="w3-bar-item w3-button w3-hover-pale-red">Orders</a>
                <a href="logout.php" class="w3-bar-item w3-button w3-pink w3-hover-pale-red w3-right">Sign Out</a>
            </div>
        </div>
        <div>
            <?php

            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                if (empty($_POST['productname'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter Product Name.</p></div>";
                } elseif (empty($_POST['price'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter Product Price.</p></div>";
                } elseif (empty($_POST['quantity'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter the Quantity.</p></div>";
                } else {

                    $productname = $_POST['productname'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];
                    $total = $quantity * $price;

                    $query = "INSERT INTO orders (OrderName, Price, Quantity, Total, UserID, farmerID) VALUES ('$productname', '$price', '$quantity', '$total', '$userId', '$farmerID')";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        echo "<div class=\"w3-panel w3-pale-green w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Success!</h3><p>Product Add Successfully.</p></div>";
                    } else {
                        echo "Error: " . "<br>" . mysqli_error($conn);
                    }
                }
            }

            ?>
            <form action="addorders.php" method="POST" class="w3-margin-top w3-margin-bottom">
                <?php

                $query = "SELECT * FROM products";
                $result = mysqli_query($conn, $query);

                if ($result) {

                    if (mysqli_num_rows($result) > 0) {

                        $productName = [];
                        $price = [];

                        while ($row = mysqli_fetch_assoc($result)) {
                            $productName[] = $row['ProductName'];
                            $priceList[] = $row['Price'];
                        }


                        echo "<div class=\"w3-margin-bottom w3-margin-top\"><select name=\"productname\" class=\"w3-select\">";
                        echo "<option value=\"\" disabled selected>Select Product</option>";
                        foreach ($productName as $product) {
                            echo "<option value='{$product}'>{$product}</option>";
                        }
                        echo "</select></div>";


                        echo "<div class=\"w3-margin-bottom w3-margin-top\"><select name=\"price\" class=\"w3-select\">";
                        echo "<option value=\"\" disabled selected>Select Price</option>";
                        foreach ($priceList as $price) {
                            echo "<option value='{$price}'>{$price}</option>";
                        }
                        echo "</select></div>";


                        echo "<label for='quantity'>Add Quantity</label>";
                        echo "<input type='number' name='quantity' class=\"w3-input\">";
                        echo "<button type='submit' class=\"w3-btn w3-pink w3-margin-top w3-hover-pale-red w3-margin-bottom\">Add Product</button>";
                    } else {

                        echo "No Products Found!" . "<br>";
                        echo "<label for='productname'>Add Product</label>";
                        echo "<input type='text' name='productname'>";
                        echo "<label for='price'>Add Price</label>";
                        echo "<input type='number' name='price'>";
                        echo "<label for='quantity'>Add Quantity</label>";
                        echo "<input type='number' name='quantity'>";
                        echo "<button type='submit'>Add Product</button>";
                    }
                }
                ?>
            </form>
        </div>

    </div>
</body>

</html>