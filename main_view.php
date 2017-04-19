<div class="col-md-3">
</div>
<div class="col-md-6" id="all-tweets">
    <div class="container-fluid">
        <h2>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo 'Hi, ' . $_SESSION['username'];
            } else {
                echo 'Lately on twitterinhoverse:';
            }
            ?></h2><hr>

        <?php
        if (isset($_SESSION['user_id'])) {
            $allTweets = Tweet::printAllUserTweets($conn, $_SESSION['user_id']);
        } else {
            $alltweets = Tweet::printAllTweets($conn);
        }
        ?>

    </div>
</div>