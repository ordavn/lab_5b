<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

$timeout_duration = 900; 

if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['LAST_ACTIVITY'])) {
        if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration) {
            session_unset();
            session_destroy();
            header('Location: login.php');
            exit();
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    header('Location: login.php');
    exit();
}
?>