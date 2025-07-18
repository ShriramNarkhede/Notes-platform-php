<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: admin_login.php');
    exit();
}

if (isset($_GET['note_id'])) {
    $id = $_GET['note_id'];
    
    $sql = "UPDATE notes SET status = 'deleted' WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: admin.php');
    } else {
        die(mysqli_error($conn));
    }
}

exit();
?>
