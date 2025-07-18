<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT id, subject, description FROM notes WHERE status = 'deleted'";
$result = mysqli_query($conn, $sql);
?>
<body>
    <style>
        .action-btn {
        display: inline-block;
        padding: 6px 12px;
        background-color: #2980b9;
        color: white;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        margin-right: 5px;
        transition: background-color 0.3s ease;
    }
    .action-btn:hover {
        background-color:rgb(92, 198, 224);
    }
    </style>
    <div class="header">
    <button class = "action-btn" ><a href="admin.php"> Go Back</a></button>
</div>
</body>
<h2>Recycle Bin (Deleted Notes)</h2>
<table border="1" cellpadding="10" width="100%">
  <tr>
    <th>ID</th>
    <th>Subject</th>
    <th>description</th>
    <th>Actions</th>
  </tr>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['subject'] ?></td>
      <td><?= $row['description'] ?></td>
      <td><button> <a href="restore_note.php?note_id=<?= $row['id'] ?>">&#x267B; Restore</a></button>
     </td>
     </td>
    </tr>
  <?php } ?>
</table>
