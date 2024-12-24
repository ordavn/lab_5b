<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'Database.php';
include 'User.php';
include 'session_timeout.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldMatric = $_POST['old_matric'];
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $result = $user->updateUser($oldMatric, $matric, $name, $role);

    $db->close();

    if ($result) {
        header("Location: display.php");
        exit();
    } else {
        echo $result;
    }
    
}