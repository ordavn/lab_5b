<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'database.php';
include 'user.php';
include 'session_timeout.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $matric = $_GET['matric'];

    $database = new database();
    $db = $database->getConnection();

    $user = new user($db);
    $result = $user->deleteUser($matric);

    $db->close();
    
    if ($result === true) {
        header("Location: display.php");
        exit();
    } else {
        echo $result;
    }
}