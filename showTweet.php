<?php

session_start();

require_once './src/entities/Tweet.php';
require_once './src/entities/Comment.php';
require_once './src/entities/User.php';
require_once './src/entities/connection.php';
require_once 'header.php';

$userId = $_SESSION['user_id'];
$tweetId = $_GET['tweetId'];

$tweet = Tweet::loadTweetById($conn, $tweetId);

$whoTweets = User::loadUserById($conn, $tweet->getUserId());

echo "<div class='col-md-3'></div>";
echo "<div class='col-md-6'><blockquote>";
echo "<h2>" .  $tweet->getText() . "</h2>";
echo "<footer>Tweeted by " . $whoTweets->getUsername() . " on "
 . $tweet->getCreationDate() . "</footer>";
echo "</blockquote><hr>";

$comments = Comment::printAllTweetComments($conn, $tweetId);

echo "</div>";
echo "<div class='col-md-3'></div>";