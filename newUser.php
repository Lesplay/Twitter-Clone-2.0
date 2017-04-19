<?php
session_start();

require_once './src/entities/User.php';
require_once './src/entities/Tweet.php';
require_once './src/entities/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newUsername']) && !empty($_POST['newUsername'])) {
        $user = new User;
        $user->setUsername(trim($_POST['newUsername']));
    } 
    else {
        echo 'Set a username!';
    }
    
    if (isset($_POST['newEmail']) && !empty($_POST['newEmail'])) {
        $user->setEmail(trim($_POST['newEmail']));
    }
    else {
        echo 'Set an e-mail!';
    }
    
    if (isset($_POST['newPassword']) && !empty($_POST['newPassword'])) {
        $user->setPassword(trim($_POST['newPassword']));
    }
    
    if (isset($_POST['newUsername']) && isset($_POST['newEmail']) 
            && isset($_POST['newPassword'])) {
        $user->saveToDB($conn);
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $_POST['newUsername'];
        
        header("Location: main.php");
    }
}
else {
    echo "Something went wrong. Try again!";
}