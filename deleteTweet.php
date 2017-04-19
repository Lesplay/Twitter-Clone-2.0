<?php
session_start();

require_once './src/entities/Tweet.php';
require_once './src/entities/connection.php';

$userId = $_SESSION['id'];
$tweetId = $_GET['tweetId'];

if (isset ($_GET['tweetId'])) {
    $deltweet = Tweet::deleteTweet($conn, $tweetId);
}

header("Location: main.php");
