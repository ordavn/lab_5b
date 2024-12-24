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
    $userDetails = $user->getUser($matric);

    $db->close();

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update User</title>
    </head>

    <body>
        <h2> Update User </h2>
        <form action="update.php" method="post">
            <input type="hidden" name="old_matric" value="<?php echo $userDetails['matric'];?>">
            <label for="matric">Matric:</label>
            <input type="text" name="matric" value="<?php echo $userDetails['matric']; ?>"><br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>"><br>
            <label for="role">Access Level:</label>
            <select name="role" id="role" required>
                <option value="">Please select</option>
                <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer')
                    echo "selected" ?>>Lecturer</option>
                    <option value="student" <?php if ($userDetails['role'] == 'student')
                    echo "selected" ?>>Student</option>
                </select><br>
                <input type="submit" value="Update">
            </form>
        </body>

        </html>
    <?php
}
?>