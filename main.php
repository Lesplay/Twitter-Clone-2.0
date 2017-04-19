<?php

session_start();
require_once './src/entities/User.php';
require_once './src/entities/Tweet.php';
require_once './src/entities/connection.php';

if (!isset($_SESSION['user_id'])) {
    require_once 'header_default.php';
    require_once 'main_view.php';
} else {
    require_once 'header.php';
    if (isset($_GET['showUserId'])) {
        require_once 'showUser.php';
    } else {
        require_once 'main_view.php';
    }
}

/*
if (isset($_SESSION['user_id'])) {
    require_once 'header.php';
} else {
    require_once 'header_default.php';
}

if (isset($_GET['showUserId'])) {
    require_once 'showUser.php';
} else {
    require_once 'main_view.php';
}
 * 
 */