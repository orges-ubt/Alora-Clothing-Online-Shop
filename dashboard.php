<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
echo "Miresevini, " . ($_SESSION['role'] == 'admin' ? "Administrator" : "Përdorues") . "!<br>";
echo "<a href='logout.php'>Dil</a>";
?>
