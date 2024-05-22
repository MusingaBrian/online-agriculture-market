<?php
session_start();
require "database.php";
?>

<?php
$user = $_SESSION['user'];
if ($user) {
    $query = "SELECT ID FROM users WHERE UserName = '$user'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $userId = $row['ID'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Agriculture Market : Add Product</title>
    <link rel="stylesheet" href="./styles/w3.css">
</head>

<body>
    <div class="w3-container w3-row w3-padding">
        <div class="w3-container w3-pink">
            <h1>Add Products</h1>
            <div class="w3-bar w3-pink w3-margin-bottom">
                <?php
                $user = $_SESSION['user'];
                echo "<span class=\"w3-bar-item w3-right\">{$user}</span>";
                ?>
                <a href="logout.php" class="w3-bar-item w3-button w3-pink w3-hover-pale-red w3-right">Sign Out</a>
                <a href="home.php" class="w3-bar-item w3-button w3-hover-pale-red">Product</a>
            </div>
        </div>

        <div class="w3-card w3-padding">
            <?php

            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                if (empty($_POST['productname'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter Product Name.</p></div>";
                } elseif (empty($_POST['price'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Product Price.</p></div>";
                } else {

                    $productname = $_POST['productname'];
                    $price = $_POST['price'];

                    $query = "INSERT INTO products (ProductName, Price, FarmerID) VALUES ('$productname', '$price', '$userId')";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        echo "<div class=\"w3-panel w3-pale-green w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Success!</h3><p>Product Add Successfully.</p></div>";
                    } else {
                        echo "Error: " . "<br>" . mysqli_error($conn);
                    }
                }
            }

            ?>

            <form action="addproducts.php" method="POST" class="w3-margin-top w3-margin-bottom">
                <label for="productname">Enter Product Name</label>
                <input type="text" name="productname" class="w3-input w3-margin-bottom">
                <label for="price">Enter Product Price</label>
                <input type="number" name="price" class="w3-input w3-margin-bottom">
                <button type="submit" class="w3-btn w3-pink w3-margin-top w3-hover-pale-red w3-margin-bottom">Add Product</button>
            </form>
        </div>
    </div>
</body>

</html>