<?php session_start() ?>
<?php require "database.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Agriculture Market : login</title>
    <link rel="stylesheet" href="./styles/w3.css">
</head>

<body>
    <div class="w3-container w3-row w3-padding-64">

        <div class="w3-container w3-pink w3-content w3-card">
            <h1>Welcome to Online Agriculture Market</h1>
            <div class="w3-bar w3-pink w3-margin-bottom">
                <a href="index.php" class="w3-bar-item w3-button w3-pink w3-hover-pale-red">Login</a>
                <a href="signup.php" class="w3-bar-item w3-button w3-hover-pale-red">Signup</a>
            </div>
        </div>

        <div class="w3-container w3-card w3-content w3-padding-16">

            <?php

            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                if (empty($_POST['email'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter Email.</p></div>";
                } elseif (empty($_POST['password'])) {
                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Please Enter Password.</p></div>";
                } else {

                    $email = $_POST['email'];
                    $password = $_POST['password'];


                    $hashed = password_hash($password, PASSWORD_BCRYPT);
                    $query = "SELECT * FROM users WHERE Email = '$email'";
                    $result = mysqli_query($conn, $query);

                    if ($result) {

                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {

                                $verified = password_verify($password, $row['Password']);

                                if ($verified) {

                                    $_SESSION['user'] = $row['UserName'];
                                    if ($row['UserType'] === 'buyer') {

                                        header("Location: http://127.0.0.1/online-agriculture-market/orders.php");
                                    } else {

                                        header("Location: http://127.0.0.1/online-agriculture-market/home.php");
                                    }
                                } else {

                                    echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Incorrect Name or password.</p></div>";
                                }
                            }
                        } else {

                            echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>No User Found!</p></div>";
                        }
                    } else {

                        echo "<div class=\"w3-panel w3-pale-red w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"class=\"w3-button w3-large w3-display-topright\">&times;</span><h3>Sorry!</h3><p>Something Went Wrong.</p></div>";
                    }

                    mysqli_close($conn);
                }
            }
            ?>
            <form action="index.php" method="post" class="w3-container">
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