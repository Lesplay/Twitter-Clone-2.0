<?php

class Tweet {

    private $id;
    private $userId;
    private $text;
    private $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->userId = "";
        $this->username = "";
        $this->text = "";
        $this->creationDate = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setText($text) {
        $this->text = $text;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function saveToDB(mysqli $conn) {
        //if this is a new tweet, save it to the DB and give it it's ID
        if ($this->id == -1) {

            $sql = "INSERT INTO Tweet(user_Id, text, creationDate)
          VALUES('{$this->userId}', '{$this->text}', '{$this->creationDate}');";

            $result = $conn->query($sql);

            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Tweet SET user_Id='{$this->userId}',
          text='{$this->text}', creationDate='{$this->creationDate}'
          WHERE id={$this->id}";

            $result = $conn->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    //wczytanie wszystkich Tweetów
    static public function loadAllTweets(mysqli $conn) {
        $sql = "SELECT Tweet.*, Users.username
               FROM Tweet
               LEFT JOIN Users
               ON Tweet.user_id=Users.id
               ORDER BY creationDate DESC;";

        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['user_Id'];
                $loadedTweet->username = $row['username'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];

                $ret[] = $loadedTweet;
            }
        }
        return $ret;
    }

    //wczytanie Tweetów o danym ID
    static public function loadTweetById(mysqli $conn, $tweetId) {
        $sql = "SELECT * FROM Tweet WHERE Tweet.id=$tweetId";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['user_Id'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];
            return $loadedTweet;
        } else {
            return False;
        }
    }

    //wczytanie Tweetów użytkownika o danym ID
    static public function loadTweetsByUser(mysqli $conn, $userId) {
        $sql = "SELECT * FROM Tweet WHERE user_Id='$userId' ORDER BY creationDate DESC";
        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedTweets = new Tweet();
                $loadedTweets->id = $row['id'];
                $loadedTweets->userId = $row['user_Id'];
                $loadedTweets->text = $row['text'];
                $loadedTweets->creationDate = $row['creationDate'];

                $ret[] = $loadedTweets;
            }
        }
        return $ret;
    }

    //wyswietlenie tweetow usera o podanym id
    static public function listUserTweets(mysqli $conn) {
        $list = self::loadTweetsByUser($conn, $userId);

        foreach ($list as $tweet) {
            echo $tweet->text . "<br>";
            echo "Tweeted on " . $tweet->creationDate . "<br>";
            echo "by " . $tweet->username . "<hr>";
        }
    }

    //wyswietlenie wszystkich komentarzy do tweeta o danym id
    static public function allTweetComments($conn) {
        $sql = "SELECT * FROM Comments
               WHERE tweet_id='$this->id'
               ORDER BY creation_date DESC";

        $result = $conn->query($sql);

        $commList = [];

        if ($result->num_rows > 0) {
            foreach ($result as $comment) {
                $comm = new Comment(
                        $comment['user_id'], $comment['tweet_id'], $comment['creationDate'], $comment['comment'], $comment['id']
                );
                $commList[] = $comm;
            }
            return $commList;
        } else {
            return False;
        }
    }

    //wydrukowanie tweeta
    static public function printAllTweets(mysqli $conn) {
        $loadTweets = Tweet::loadAllTweets($conn);

        foreach ($loadTweets as $tweets) {
            $whoTweets = User::loadUserById($conn, $tweets->userId);

            echo "<blockquote>";
            echo "<p> $tweets->text </p>";
            echo "<footer>Tweeted by " . $whoTweets->getUsername() . " on "
            . $tweets->creationDate . "</footer>";
            echo "</blockquote>";
        }
    }

    static public function printAllUserTweets(mysqli $conn, $userId) {
        $loadTweets = Tweet::loadTweetsByUser($conn, $userId);
        foreach ($loadTweets as $tweet) {
            $tweetId = $tweet->getId();

            echo "<h3>" . $tweet->getText() . "</h3>";
            echo "<p><small>Tweeted by you on " . $tweet->getCreationDate() .
            "</small></p><br>";
            echo "<a href=showTweet.php?tweetId=$tweetId><button type='submit' class='btn btn-primary'>Show comments</button></a>" .
            "<a href='deleteTweet.php?tweetId=$tweetId'><button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span>&nbsp;&nbsp;Remove tweet</button></a>" . "<hr>";
        }
    }

    static public function deleteTweet(mysqli $conn, $tweetId) {
        if ($tweetId != -1) {
            $sql = "DELETE FROM Tweet WHERE id=$tweetId";
            $result = $conn->query($sql);
            if ($result == true) {
                $tweetId = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
