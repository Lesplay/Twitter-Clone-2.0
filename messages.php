<?php
session_start();
require_once './src/entities/User.php';
require_once './src/entities/Tweet.php';
require_once './src/entities/Message.php';
require_once './src/entities/connection.php';

require_once 'header.php';
?>
<div class="col-md-2">
</div>
<div class="col-md-8">
    <div>
        <div class="container-fluid">
            <h2>Send message</h2><hr>
            <form class ="row" method="POST" action="newMessage.php">
                <div>
                    <input type="text" name="recipientName" placeholder="Who to?" class="btn-block"><br>
                    <textarea id="message-area" maxlength="140" rows="5" cols="107" name="message">
                        
                    </textarea><br>
                    <button type="submit" class="btn btn-primary btn-block">Send</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        
        <div class="col-md-6">
            <h3>Received messages:</h3>
            <?php
            $allReceivedMsgs = Message::loadUsersReceivedMessages($conn, $_SESSION['user_id']);

            foreach ($allReceivedMsgs as $message) {
                $user_sender = User::loadUserById($conn, $message->getSender_id());
                echo $user_sender->getUsername() . " sent you a message: <br>";
                echo $message->getMessage() . "<br>";
                echo "on " . $message->getCreation_date() . "<hr>";
                //echo "<a href='sendMessage.php?receiver_id=" . $message->getSender_id() . "&sender_id=" . $_SESSION['user_id'] . "'>Reply</a><hr>";
            }
            ?>
        </div>
        <div class="col-md-6">
            <h3>Sent messages:</h3>
            <?php
            $allSentMsgs = Message::loadUsersSentMessages($conn, $_SESSION['user_id']);

            foreach ($allSentMsgs as $message) {
                $user_sender = User::loadUserById($conn, $message->getSender_id());
                echo "You have sent " . $user_sender->getUsername() . " a message:<br>";
                echo $message->getMessage() . "<br>";
                echo "on " . $message->getCreation_date() . "<hr>";
            }
            ?>
        </div>
    </div>
</div>