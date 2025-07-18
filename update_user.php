<?php
include 'db.php';

if (!isset($_GET['updateid'])) {
    die("User ID not specified.");
}

$id = $_GET['updateid'];
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$name = $row["name"];
$email = $row["email"];
$admin = $row["is_admin"];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];

    $sql = "UPDATE users SET name='$name', email='$email',is_admin='$admin' Where id= $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header(header: 'Location: admin.php');
        exit();
    } else {
        die(mysqli_error($conn));
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Update User Data</title>
</head>  
<style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color:rgb(110, 166, 250);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 25px;
        }

        /* .form-container {
            background-color: palevioletred;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(244, 2, 2, 0.1);
            width: 400px;
        } */

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: black;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-link {
            margin-top: 15px;
            text-align: center;
        }

        .back-link a {
            text-decoration: none;
            color: #4CAF50;
        }
    </style>
<body>
    
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br><br>

        <label>Assign Admin (0 = No, 1 = Yes):</label>
        <input type="number" name="admin" value="<?= htmlspecialchars($admin) ?>" min="0" max="1" required><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>

</html>