<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: admin_login.php');
    exit();
}

$users = mysqli_query($conn, "SELECT * FROM users");

$notes = mysqli_query($conn, "SELECT * FROM notes WHERE status = 'active'");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        .header { background: #333; color: white; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: white; text-decoration: none; background: red; padding: 5px 10px; border-radius: 5px; }
        .action-btn { margin-right: 10px; }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f6f8;
        color: #333;
    }

    .header {
        background-color: #2c3e50;
        color: white;
        padding: 20px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 18px;
    }

    .header a {
        color: #fff;
        text-decoration: none;
        background-color: #e74c3c;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .header a:hover {
        background-color: #c0392b;
    }

    h2 {
        text-align: center;
        margin-top: 30px;
        color: #2c3e50;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
    }

    th, td {
        padding: 14px 18px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #3498db;
        color: white;
        font-weight: 600;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

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
        background-color: #1c5980;
    }

    button.action-btn a {
        color: white;
        text-decoration: none;
    }

    button.action-btn {
        background-color: #e74c3c;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button.action-btn:hover {
        background-color: #c0392b;
    }
    </style>
</head>
<body>

<div class="header">
    <div>Welcome Admin, <?php echo htmlspecialchars($_SESSION['name']); ?>!</div>
    <div><a href="logout.php" float:right >Logout</a></div>
    <a href="recycle_bin.php"> Recycle Bin</a>
</div>

<h2>Manage Users</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Admin</th>
        <th>Actions</th>
    </tr>
    <?php while($user = mysqli_fetch_assoc($users)) { ?>
    <tr>
        <td><?php echo $user['id']; ?></td> 
        <td><?php echo htmlspecialchars($user['name']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td><?php echo $user['is_admin'] ? 'Yes' : 'No'; ?></td>   
        <td>
            <a class="action-btn" href="update_user.php?updateid=<?php echo $user['id']; ?>">Edit</a>
            <a class="action-btn" href="delete_user.php?delid=<?php echo $user['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<h2>Manage Notes</h2>
<table>
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Subject</th>
        <th>Description</th>
        <th>Filename</th>
        <th>Uploaded At</th>
        <th>Actions</th>
    </tr>
    <?php while($note = mysqli_fetch_assoc($notes)) { ?>
    <tr>
        <td><?php echo $note['id']; ?></td>
        <td><?php echo $note['user_id']; ?></td>
        <td><?php echo htmlspecialchars($note['subject']); ?></td>
        <td><?php echo htmlspecialchars($note['description']); ?></td>
        <td><?php echo htmlspecialchars($note['filename']); ?></td>
        <td><?php echo $note['uploaded_at']; ?></td>
        <td>
           <button class="action-btn"> <a href="delete_note.php?note_id=<?php echo $note['id']; ?> " >Delete</a></button>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
