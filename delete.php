<?php
require_once "user.php";

$user = new User();

if (!isset($_GET['id'])) {
    die("User ID not specified.");
}

$id = intval($_GET['id']);
if ($user->deleteUser($id)) {
    header("Location: dashboard.php?message=User+deleted+successfully");
    exit;
} else {
    die("Error deleting user.");
}
?>