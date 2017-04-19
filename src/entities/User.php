<?php

class User {

    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->hashedPassword = "";
        $this->email = "";
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function getEmail() {
        return $this->email;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    public function saveToDB(mysqli $conn) {
        //if this is a new user, save it to the DB and give it it's ID
        if ($this->id == -1) {
            $sql = "INSERT INTO Users(username, email, hashed_password)
            VALUES('$this->username', '$this->email', '$this->hashedPassword');";

            $result = $conn->query($sql);

            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return True;
            }
        } else {
            $sql = "UPDATE Users SET username='$this->username',
            email='$this->email',
            hashed_password='$this->hashedPassword'
            WHERE id=$this->id";

            $result = $conn->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    static public function loadUserById(mysqli $conn, $id) {
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = $conn->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }
    
    static public function loadUserByUsername(mysqli $conn, $username) {
        $sql = "SELECT * FROM Users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }
    
    static public function loadAllUsers(mysqli $conn) {
        $sql = "SELECT * FROM Users";
        $ret = [];

        $result = $conn->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];

                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    public function delete(mysqli $conn) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $conn->query($sql);
            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
