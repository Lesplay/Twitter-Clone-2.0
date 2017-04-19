<?php
session_start();
require_once './src/entities/User.php';
require_once './src/entities/Tweet.php';
require_once './src/entities/connection.php';

require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $user_id = $_SESSION['user_id'];
        
        $updatedUser = User::loadUserById($conn, $user_id);
        $updatedUser->setUsername($_POST['username']);
        $updatedUser->saveToDB($conn);
        if ($updatedUser->saveToDB($conn) == true) {
            echo "<div class='container'><div class='alert alert-success alert-dismissable fade in'>
            <strong>Zmieniono nazwę! Wyloguj się i zaloguj ponownie.</strong></div></div>";
        } else {
            echo "<div class='container'><div class='alert alert-danger alert-dismissable fade in'>
            <strong>E-mail lub hasło jest niepoprawne</strong></div></div>";
        }
    }
}
?>
<div class="col-md-3">
</div>
<div class="col-md-6">
    <div class="container-fluid">
        <h2>Settings</h2><hr>
        <div class="container-fluid form-group" id="placeholder-settings-form">
            <form class ="row" method="POST" action="#">
                <div>
                    <label><p>Change your username</p></label>
                    <input type="text" name="username" placeholder="Your new username" class="btn-block"><br>
                    <input type="text" name="email" placeholder="Confirm your e-mail" class="btn-block"><br>
                    <input type="password" name="password" placeholder="Confirm your password" class="btn-block"><br>
                    <button type="submit" name="change-settings" class="btn btn-primary btn-block">
                        <span class=""></span>&nbsp;&nbsp;Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>