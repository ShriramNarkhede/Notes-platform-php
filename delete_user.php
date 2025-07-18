<?php
include 'db.php';

if (isset($_GET['delid'])) {
    $id = $_GET['delid'];

    $sql = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: admin.php');
        exit();
    } else {
        die(mysqli_error($conn));
    }
}
?>