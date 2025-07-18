<?php
include 'db.php';

// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if note ID is provided
if (isset($_GET['note_id']) && is_numeric($_GET['note_id'])) {
    $id = intval($_GET['note_id']); // Ensure it's an integer for safety

    // Run the update query to restore the note
    $sql = "UPDATE notes SET status = 'active' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Check result
    if ($result) {
        echo "<script>alert('Note restored successfully.'); window.location.href='recycle_bin.php';</script>";
    } else {
        echo "Error restoring note: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. Note ID not set or invalid.";
}
?>
