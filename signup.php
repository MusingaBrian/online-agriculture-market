<?php session_start() ?>
<?php require "database.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Agriculture Market : Signup</title>
    <link rel="stylesheet" href="./styles/w3.css">
</head>

<body>
    <div class="w3-container w3-row w3-padding-64">
        <div class="w3-container w3-pink w3-content w3-card">
            <h1>Welcome to Online Agriculture Market : Sign UP</h1>
            <div class="w3-bar w3-pink w3-margin-bottom">
                <a href="index.php" class="w3-bar-item w3-button w3-hover-pale-red">Login</a>
                <a href="#" class="w3-bar-item w3-button w3-pink w3-hover-pale-red">Signup</a>
            </div>
        </div>
        <div class="w3-container w3-card w3-content w3-padding-16">
            <?php

            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                if (empty($_POST['username'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter User Name.</p></div>";
                } elseif (empty($_POST['email'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter Email.</p></div>";
                } elseif (empty($_POST['password'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter Password.</p></div>";
                } elseif (empty($_POST['type'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Select A User Type.</p></div>";
                } else {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $type = $_POST['type'];

                    $hashed = password_hash($password, PASSWORD_BCRYPT);

                    $query = "INSERT INTO users (Username, Email, UserType, Password) VALUES ('$username', '$email', '$type','$hashed')";

                    if (mysqli_query($conn, $query)) {

                        $_SESSION['user'] = $username;
                        header("Location: http://127.0.0.1/online-agriculture-market/home.php");
                    } else {

                        echo "Error: " . "<br>" . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                }
            }

            ?>
            <form action="signup.php" method="post" class="w3-container">
                <label for="email">Enter User Name:</label>
                <input type="text" name="username" class="w3-input w3-margin-bottom">
                <div class="w3-margin-bottom">
                    <label for="type">Select User Type:</label>
                    <input type="radio" name="type" value="admin" class="w3-radio">
                    <label for="type">Admin</label>
                    <input type="radio" name="type" value="farmer" class="w3-radio">
                    <label for="type">Farmer</label>
                    <input type="radio" name="type" value="buyer" class="w3-radio">
                    <label for="type" class="">Buyer</label>
                </div>
                <label for="email">Enter Email:</label>
                <input type="email" name="email" class="w3-input w3-margin-bottom">
                <label for="password">Enter Password:</label>
                <input type="password" name="password" class="w3-input w3-margin-bottom">
                <button type="submit" class="w3-btn w3-pink w3-margin-top w3-hover-pale-red">login</button>
            </form>
        </div>
    </div>
</body>

</html>