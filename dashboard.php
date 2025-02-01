<?php
require_once "user.php";
$user = new User();
$result = $user->read();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 800px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { text-decoration: none; color: blue; }
        .action-links a { margin-right: 10px; }
        .message { color: green; }
    </style>
</head>
<body>
<div class="container">
    <h2>User Dashboard</h2>
    <?php 
    if(isset($_GET['message'])) {
        echo '<p class="message">' . htmlspecialchars($_GET['message']) . '</p>';
    }
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['surname']); ?></td>
            <td><?php echo htmlspecialchars($row['phoneNumber']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td class="action-links">
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
