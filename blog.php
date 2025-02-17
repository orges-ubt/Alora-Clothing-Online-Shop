<?php
require_once "post.php";

$postObj = new Post();

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
    
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
        
        if (empty($error)) {
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
$posts = $postObj->getPosts();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Reviews</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: DM Sans, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .review-form {
            margin-bottom: 40px;
            padding: 20px;
            border: 1px solid #ddd;
            background: #f9f9f9;
        }
        .review-form textarea {
            width: 100%;
            height: 100px;
            padding: 8px;
            resize: vertical;
        }
        .review-form input[type="file"] {
            margin-top: 10px;
        }
        .review-form input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .post {
            border-bottom: 1px solid #ddd;
            padding: 20px 0;
        }
        .post:last-child {
            border-bottom: none;
        }
        .post h3 {
            margin: 0 0 10px;
            color: #007BFF;
        }
        .meta {
            color: #999;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .post p {
            line-height: 1.6;
            color: #333;
        }
        .post img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
        .actions {
            margin-top: 10px;
        }
        .actions a {
            display: inline-block;
            margin-right: 10px;
            padding: 5px 10px;
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .actions a.delete {
            background: #FF4136;
        }
    </style>
</head>
<body>
<nav class="navbar">
  <div id="nav-logo">
    <a href="index.php"><img src="images/logo.png" alt="Alora Logo"></a>
  </div>
  <div class="nav-ul">
    <ul>
      <?php
      session_start();
      if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
          echo '<li id="dashboard"><a href="dashboard.php">Dashboard</a></li>';
      }
      ?>
      <li><a href="index.php">Home</a></li>
      <li><a href="products.php">Products</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="blog.php">Blog</a></li>
      <?php
      if (!isset($_SESSION['user_id'])) {
          echo '<li><a href="login.php"><svg width="33px" height="33px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="user"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></a></li>';
      }
      ?>
      <?php
      if (isset($_SESSION['user_id'])) {
          echo '<li><a href="logout.php" style="padding: 10px 15px; background-color: rgb(212, 203, 203);color:white; text-decoration: none; border-radius: 4px;">Logout</a></li>';
      }
      ?>
    </ul>
  </div>
</nav>
<div class="container">
    <h1>Blog Reviews</h1>
    <?php if (isset($_SESSION['user_id'])) { ?>
        <div class="review-form">
            <h2>Write a Review</h2>
            <?php 
            if (!empty($error)) { 
                echo '<p class="message error">' . $error . '</p>'; 
            }
            if (!empty($success)) { 
                echo '<p class="message success">' . $success . '</p>'; 
            }
            ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <textarea name="review" placeholder="Write your review here..." required></textarea>
                <br>
                <label for="image">Upload a picture (optional):</label>
                <input type="file" name="image" accept="image/*">
                <br>
                <input type="submit" name="submit_review" value="Post Review">
            </form>
        </div>
    <?php } else { ?>
        <div class="review-form">
            <h2>Write a Review</h2>
            <p class="message">Please <a href="login.php">login</a> to post a review.</p>
        </div>
    <?php } ?>
    <?php while($row = $posts->fetch_assoc()) { ?>
        <div class="post">
            <h3><?php echo htmlspecialchars($row['name'] . " " . $row['surname']); ?></h3>
            <div class="meta">
                Posted on <?php echo htmlspecialchars($row['created_at']); ?>
            </div>
            <p><?php echo nl2br(htmlspecialchars($row['review'])); ?></p>
            <?php if (!empty($row['image'])) { ?>
                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Review Image">
            <?php } ?>
            <?php
            if (isset($_SESSION['user_id']) &&
                ( ($_SESSION['user_id'] == $row['user_id']) ||
                  (isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
                )
            ) { ?>
                <div class="actions">
                    <a href="blog_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="delete" href="blog_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
</body>
</html>
