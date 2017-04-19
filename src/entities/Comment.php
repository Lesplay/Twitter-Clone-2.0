<?php

class Comment {

    private $id;
    private $userId;
    private $tweetId;
    private $creationDate;
    private $comment;

    public function __construct() {
        $this->id = "";
        $this->userId = "";
        $this->tweetId = "";
        $this->creationDate = "";
        $this->comment = "";
    }

    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getTweetId() {
        return $this->tweetId;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getComment() {
        return $this->comment;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setTweetId($tweetId) {
        $this->tweetId = $tweetId;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setComment($comment) {
        $this->comment = $comment;
    }

    public function saveToDB(mysqli $conn) {

        if ($this->id == -1) {

            $sql = "INSERT INTO Comments(user_id, tweet_id, creationDate, comment)
                    VALUES('$this->userId', '$this->tweetId', '$this->creationDate', '$this->comment');";

            $result = $conn->query($sql);

            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return True;
            }
        } else {
            $sql = "UPDATE Comments SET creationDate='$this->creationDate',
                    comment='$this->comment'
                    WHERE id=$this->id";

            $result = $conn->query($sql);

            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    static public function allTweetComments(mysqli $conn, $tweetId) {
        $sql = "SELECT * FROM Comments WHERE tweet_id = $tweetId ORDER BY creationDate DESC";
        $ret = [];

        $result = $conn->query($sql);

        if ($result->num_rows != 0) {
            foreach ($result as $row) {
                $comment = new Comment();
                $comment->id = $row['id'];
                $comment->userId = $row['user_id'];
                $comment->tweetId = $row['tweet_id'];
                $comment->creationDate = $row['creationDate'];
                $comment->comment = $row['comment'];

                $ret[] = $comment;
            }
        }

        return $ret;
    }

    static public function printAllTweetComments(mysqli $conn, $tweetId) {
        $loadComments = Comment::allTweetComments($conn, $tweetId);
        
        foreach ($loadComments as $comment) {
            $commentator = User::loadUserById($conn, $comment->getUserId());
            echo "<h4>" . $comment->getComment() . "</h4>";
            echo "<p><small>Comment by " . "<a href=main.php?showUserId=" . $commentator->getId() . ">" . $commentator->getUsername() . "</a>" . " on " . $comment->getCreationDate() .
            "</small></p><br>";
        }
    }

}
