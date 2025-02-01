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
    die("You do not have permission to delete this review.");
}

if (!empty($currentPost['image'])) {
    $imagePath = "uploads/" . $currentPost['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

if ($postObj->deletePost($id)) {
    header("Location: blog_dashboard.php?message=Review+deleted+successfully");
    exit;
} else {
    die("Error deleting review.");
}
?>
