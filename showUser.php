<?php
require_once './src/entities/Tweet.php';
require_once './src/entities/User.php';
require_once './src/entities/connection.php';


?>

<div class="col-md-3">
</div>
<div class="col-md-6">
    <div class="container-fluid">
        <h2>
            <?php
            if (isset($_GET['showUserId'])) {
                $showUser = User::loadUserById($conn, $_GET['showUserId']);
                echo 'Viewing ' . $showUser->getUsername() . "'s tweets";
            } else {
                echo 'Something went wrong.';
            }
            ?></h2><hr>

        <?php
        if (isset($_GET['showUserId'])) {
            $allTweets = Tweet::printAllUserTweets($conn, $_GET['showUserId']);
        } else {
            $alltweets = Tweet::printAllTweets($conn);
        }
        ?>

    </div>
</div>