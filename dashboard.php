<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name']; 
// Only show shared notes that are 'active'
$result = $conn->query("SELECT notes.*, users.name AS uploader 
        FROM notes 
        JOIN users ON notes.user_id = users.id 
        WHERE notes.status = 'active' 
        ORDER BY uploaded_at DESC");
// $sql = "SELECT * from notes where status= 'active'";
// $result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard | Notes Hub</title>
  <link rel="stylesheet" href="./dashboard.css" />
</head>
<body>
  <header class="dashboard-header">
    <h1>📚 Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
  </header>

  <!-- Upload Form -->
  <div class="upload-card">
    <h2>📤 Share Your Notes</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="file">Upload File (.pdf, .docx, .txt)</label>
        <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.txt" required>
      </div>
      <button type="submit" class="upload-btn">Upload Note</button>
    </form>
  </div>

  <!-- Notes Feed -->
  <section class="notes-feed">
    <h2>🗂️ All Shared Notes</h2>
    <?php while ($row = $result->fetch_assoc()) : ?>
      <div class="note-card">
        <h3><?php echo htmlspecialchars($row['subject']); ?></h3>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <p><strong>Uploaded by:</strong> <?php echo htmlspecialchars($row['uploader']); ?></p>
        <a href="<?php echo htmlspecialchars($row['filename']); ?>" download class="download-btn">📥 Download</a>
      </div>
    <?php endwhile; ?>
  </section>
</body>
</html>
<a href="logout.php">Logout</a>
