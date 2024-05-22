<?php

/**
 * This file is responsible for connect to the mysql database.
 */

$host = "localhost";                    //This is database Server running at Localhost port 3306.
$username = "root";                     //This is the admin user of the database.
$password = "";                         //This server has no password.
$database = "online-agriculture-market";    //This is the Database Name

// PHP builtin function to connect to the database.
//The $conn variable is responsible for storing the result of the mysqli_connect function.

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Could Not connect To the database" . mysqli_connect_error());
}