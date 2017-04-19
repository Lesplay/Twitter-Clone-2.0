<?php

$serverName = "localhost";
$username = "root";
$password = "coderslab";
$database = "Twitter";

//setting the connection
$conn = new mysqli($serverName, $username, $password, $database);

//checking connection
if($conn->connect_error) {
    die ("Connection Error: " . $conn->connect_error);
} else {
    $conn->set_charset("utf8");
}