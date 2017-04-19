<?php

session_start();
require_once './src/entities/User.php';
require_once './src/entities/Tweet.php';
require_once './src/entities/connection.php';
require_once './src/entities/Message.php';
require_once './src/entities/Comment.php';

/*
  $message = new Message();

  $message->setSender_id(31);
  $message->setReceiver_id(12);
  $message->setMessage('Testowa wiadomosc');
  $message->setCreation_date(date('Y-m-d'));
  $message->saveToDB($conn);
 */
/*
  $comment = new Comment();

  $comment->setTweetId(8);
  $comment->setUserId(31);
  $comment->setComment('Test koment');
  $comment->setCreationDate(date('Y-m-d'));
  $comment->saveToDB($conn);
 */

$name = 'CarycaKatarzyna';
$user = User::loadUserByUsername($conn, $name);
var_dump($user);