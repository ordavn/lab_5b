<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'database.php';
include 'user.php';
include 'session_timeout.php';

$database = new database();
$db = $database->getConnection();

$user = new user($db);
$result = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["matric"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["role"]; ?></td>
                    <td><a href="update-form.php?matric=<?php echo $row["matric"]; ?>">Update</a></td>
                    <td><a href="delete.php?matric=<?php echo $row["matric"]; ?>">Delete</a></td>

                </tr>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }

        $db->close();
        ?>
    </table>
</body>

</html>