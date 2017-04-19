<?php
session_start();
require_once './src/entities/User.php';
require_once './src/entities/Tweet.php';
require_once './src/entities/Message.php';
require_once './src/entities/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['recipientName']) && isset($_POST['message'])) {
        $creation_date = Date('Y-m-d');
        $sender_id = $_SESSION['user_id'];
        $recipient = User::loadUserByUsername($conn, $_POST['recipientName']);
        $text = $_POST['message'];
        
        var_dump($recipient);
        
        $message = new Message();
        
        $message->setSender_id($sender_id);
        $message->setReceiver_id($recipient->getId());
        $message->setMessage($text);
        $message->setCreation_date($creation_date);
        $message->saveToDB($conn);
    }
    
    header("Location: messages.php");
}