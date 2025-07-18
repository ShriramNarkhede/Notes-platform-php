<?php
session_start();
$host = "localhost";
$user = "root"; // or your DB username
$pass = "";     // your DB password
$db   = "notes_platform";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to upload notes.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject     = $_POST['subject'];
    $description = $_POST['description'];
    $user_id     = $_SESSION['user_id'];

    $file = $_FILES['file'];
    $filename = basename($file['name']);
    $target = "uploads" . uniqid() . "_" . $filename;

    if (move_uploaded_file($file['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO notes (user_id, subject, description, filename) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $subject, $description, $target);

        if ($stmt->execute()) {
            header("Location: dashboard.php?success=1");
        } else {
            echo "Error saving note info.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
