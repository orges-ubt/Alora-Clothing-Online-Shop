<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once "post.php";
$postObj = new Post();
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
            $error = "Error: File size is larger than the allowed limit.";
        }
        if (in_array($filetype, $allowed)) {
            $newFilename = uniqid() . "." . $ext;
            $upload_dir = "uploads/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newFilename)) {
                $error = "Error: There was a problem uploading your file.";
            }
        } else {
            $error = "Error: There was a problem with the file upload. Please try again.";
        }
    } else {
        $newFilename = ""; 
    }
    
    if (empty($review)) {
        $error = "Review cannot be empty.";
    }
    
    if (empty($error)) {
        if ($postObj->createPost($_SESSION['user_id'], $review, $newFilename)) {
            $success = "Review posted successfully.";
        } else {
            $error = "Error posting review.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Review</title>
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
    <h2>Create a Review</h2>
    <?php if ($error) { echo '<p class="error">'.$error.'</p>'; } ?>
    <?php if ($success) { echo '<p class="success">'.$success.'</p>'; } ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="review">Your review:</label>
        <textarea name="review" required></textarea>
        
        <label for="image">Upload a picture (optional):</label>
        <input type="file" name="image" accept="image/*">
        
        <input type="submit" value="Post Review">
    </form>
    <p><a href="blog_dashboard.php">Back to reviews</a></p>
</div>
</body>
</html>