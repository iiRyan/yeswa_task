<?php
include("include/auth_session.php");
require('include/db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="include/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Home</title>
</head>

<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <h4>Hey, <?php echo $_SESSION['username']; ?>!</h4>
        <p><a href="logout.php">Logout</a></p>
        <a class="btn btn-secondary" href="create.php" role="button"> New Client</a>
        <br>
        <br>
        <table class="table table-dark table-borderless">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        <table class="table">
            <tbody>
                <?php
                // Read all row from database table
                $sql = "SELECT * FROM clients";
                $result = $conn->query($sql);
                if (!$result) {
                    die("Invalid query:" . $conn->error);
                }
                // Read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo " 
            <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[created_at]</td>
                <td>
                    <a class='btn btn-secondary btn-sm' href='edit.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Delete</a>
                </td>
        </tr>
            ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>