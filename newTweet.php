<?php

session_start();
require_once './src/entities/Tweet.php';
require_once './src/entities/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tweet'])) {
        $date = gmdate("Y-m-d");
        $text = $_POST['tweet'];
        $userId = $_SESSION['user_id'];
        
        $tweet = new Tweet();
        
        $tweet->setUserId($userId);
        $tweet->setText($text);
        $tweet->setCreationDate($date);
        $tweet->saveToDB($conn);
        
        header("Location: main.php");
    }
}