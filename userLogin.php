<?php
session_start();

require_once './src/entities/User.php';
require_once './src/entities/Tweet.php';
require_once './src/entities/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $sql = "SELECT * FROM Users WHERE email = '$email';";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (password_verify($password, $row['hashed_password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            header("Location: main.php");
        } else {
            echo 'The email and/or password do not match';
        }
    }
}