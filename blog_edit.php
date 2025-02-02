<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once "post.php";
$postObj = new Post();

if (!isset($_GET['id'])) {
    die("Review ID not specified.");
}
$id = intval($_GET['id']);
$currentPost = $postObj->getPostById($id);
if (!$currentPost) {
    die("Review not found.");
}

if ($_SESSION['user_id'] != $currentPost['user_id'] && (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')) {
    die("You do not have permission to edit this review.");
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review = trim($_POST['review']);
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = array("jpg" => "image/jpeg", "jpeg" => "image/jpeg", "png" => "image/png", "gif" => "image/gif");
        $filename = $_FILES['image']['name'];
        $filetype = $_FILES['image']['type'];
        $filesize = $_FILES['image']['size'];
        
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!array_key_exists($ext, $allowed)) {
            $error = "Error: Please select a valid file format.";
        }
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            $error = "Error: File size exceeds allowed limit.";
        }
        if (in_array($filetype, $allowed)) {
            $newFilename = uniqid() . "." . $ext;
            $upload_dir = "uploads/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newFilename)) {
                $error = "Error uploading file.";
            }
        } else {
            $error = "Error: Problem with file upload.";
        }
    } else {
        $newFilename = null; 
    }
    
    if (empty($review)) {
        $error = "Review cannot be empty.";
    }
    
    if (empty($error)) {
        if ($postObj->updatePost($id, $review, $newFilename)) {
            $success = "Review updated successfully.";
            $currentPost = $postObj->getPostById($id);
        } else {
            $error = "Error updating review.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
    <style>
      body { font-family: DM Sans, sans-serif; }
      .container { width: 600px; margin: auto; }
      .error { color: red; }
      .success { color: green; }
      label { display: block; margin-top: 10px; }
      textarea { width: 100%; padding: 8px; }
      input[type=file] { margin-top: 10px; }
      input[type=submit] { margin-top: 10px; padding: 10px 20px; }
      a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Your Review</h2>
    <?php if ($error) { echo '<p class="error">'.$error.'</p>'; } ?>
    <?php if ($success) { echo '<p class="success">'.$success.'</p>'; } ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="review">Your Review:</label>
        <textarea name="review" required><?php echo htmlspecialchars($currentPost['review']); ?></textarea>
        
        <p>Current Picture: 
            <?php 
            if (!empty($currentPost['image'])) {
                echo '<img src="uploads/' . htmlspecialchars($currentPost['image']) . '" alt="Review Image" style="max-width:200px;">';
            } else {
                echo 'No image uploaded';
            }
            ?>
        </p>
        
        <label for="image">Upload new picture:</label>
        <input type="file" name="image" accept="image/*">
        
        <input type="submit" value="Update Review">
    </form>
    <p><a href="blog_dashboard.php">Back to Reviews</a></p>
</div>
</body>
</html>
