<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['role'] == 'admin') {
    echo "Welcome admin!<br>";
} else {
    echo "Welcome user!<br>";
}
echo "<a href='logout.php'>Log out</a>";
?>
