<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once "post.php";
$postObj = new Post();

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $posts = $postObj->getPosts();
} else {
    $posts = $postObj->getPosts($_SESSION['user_id']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Dashboard</title>
    <style>
      body { font-family: , sans-serif; }
      .container { width: 900px; margin: auto; }
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
    <h2>Blog Dashboard - Manage Reviews</h2>
    <?php 
    if (isset($_GET['message'])) {
        echo '<p class="message">' . htmlspecialchars($_GET['message']) . '</p>';
    }
    ?>
    <p><a href="blog_create.php">Create new review</a></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Review</th>
            <th>Picture</th>
            <th>Posted by</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $posts->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['review']); ?></td>
            <td>
                <?php 
                if (!empty($row['image'])) {
                    echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" alt="Review Image" style="max-width:100px;">';
                } else {
                    echo 'No image';
                }
                ?>
            </td>
            <td>
                <?php 
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    echo htmlspecialchars($row['name']) . " " . htmlspecialchars($row['surname']);
                } else {
                    echo "You";
                }
                ?>
            </td>
            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
            <td class="action-links">
                <a href="blog_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="blog_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>