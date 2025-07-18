<?php
$host = "localhost";
$user = "root"; // or your DB username
$pass = "";     // your DB password
$db   = "notes_platform";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
