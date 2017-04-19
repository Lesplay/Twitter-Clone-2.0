<?php

class Message {

    private $id;
    private $sender_id;
    private $receiver_id;
    private $message;
    private $creation_date;

    public function __construct() {
        $this->id = -1;
        $this->sender_id = "";
        $this->receiver_id = "";
        $this->message = "";
        $this->creation_date = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getSender_id() {
        return $this->sender_id;
    }

    public function getReceiver_id() {
        return $this->receiver_id;
    }

    public function getCreation_date() {
        return $this->creation_date;
    }
    
    public function getMessage() {
        return $this->message;
    }

    function setSender_id($sender_id) {
        $this->sender_id = $sender_id;
    }

    public function setReceiver_id($receiver_id) {
        $this->receiver_id = $receiver_id;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setCreation_date($creation_date) {
        $this->creation_date = $creation_date;
    }

    public function saveToDB(mysqli $conn) {
        //if this is a new Message, save it to the DB and give it it's ID
        if ($this->id == -1) {

            $sql = "INSERT INTO Messages(sender_id, receiver_id, message, creation_date)
          VALUES('{$this->sender_id}', '{$this->receiver_id}', '{$this->message}', '{$this->creation_date}');";

            $result = $conn->query($sql);

            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Messages SET sender_id='{$this->sender_id}',
          receiver_id='{$this->receiver_id}', message='{$this->message}', 
          creation_date='{$this->creation_date}'
          WHERE id={$this->id}";

            $result = $conn->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    static public function loadUsersSentMessages(mysqli $conn, $user_id) {
        $sql = "SELECT * FROM Messages WHERE Messages.sender_id=$user_id ORDER BY creation_date DESC";
        $ret = [];

        $result = $conn->query($sql);

        if ($result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->sender_id = $row['sender_id'];
                $loadedMessage->receiver_id = $row['receiver_id'];
                $loadedMessage->message = $row['message'];
                $loadedMessage->creation_date = $row['creation_date'];
                $ret[] = $loadedMessage;
            }
        } 
        return $ret;
    }

    static public function loadUsersReceivedMessages(mysqli $conn, $user_id) {
        $sql = "SELECT * FROM Messages WHERE Messages.receiver_id=$user_id ORDER BY creation_date DESC";
        $ret = [];

        $result = $conn->query($sql);

        if ($result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->sender_id = $row['sender_id'];
                $loadedMessage->receiver_id = $row['receiver_id'];
                $loadedMessage->message = $row['message'];
                $loadedMessage->creation_date = $row['creation_date'];
                $ret[] = $loadedMessage;
            }
        } 
        return $ret;
    }

    static public function deleteMessage(mysqli $conn, $message_id) {
        if ($message_id != -1) {
            $sql = "DELETE FROM Messages WHERE id=$message_id";
            $result = $conn->query($sql);
            if ($result == true) {
                $$message_id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
