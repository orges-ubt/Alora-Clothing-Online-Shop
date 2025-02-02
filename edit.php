<?php
require_once "user.php";

$user = new User();

if (!isset($_GET['id'])) {
    die("User ID not specified.");
}

$id = intval($_GET['id']);
$currentUser = $user->getSingleUser($id);
if (!$currentUser) {
    die("User not found.");
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    
    if (empty($name) || empty($surname) || empty($phoneNumber) || empty($email)) {
        $error = "Please fill in all required fields.";
    } elseif (!empty($password) && ($password !== $confirmPassword)) {
        $error = "Passwords do not match.";
    } else {
        $updated = $user->updateUser($id, $name, $surname, $phoneNumber, $email, (!empty($password) ? $password : null));
        if ($updated) {
            header("Location: dashboard.php?message=User+updated+successfully");
            exit;
        } else {
            $error = "Error updating user.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        body { font-family: DM Sans, sans-serif; }
        .container { width: 500px; margin: auto; }
        .error { color: red; }
        label { display: block; margin-top: 10px; }
        input[type=text], input[type=password], input[type=email] { width: 100%; padding: 8px; }
        input[type=submit] { margin-top: 10px; padding: 10px 20px; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit User</h2>
    <?php if ($error) { echo '<p class="error">' . $error . '</p>'; } ?>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($currentUser['name']); ?>" required>

        <label for="surname">Surname:</label>
        <input type="text" name="surname" value="<?php echo htmlspecialchars($currentUser['surname']); ?>" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="text" name="phoneNumber" value="<?php echo htmlspecialchars($currentUser['phoneNumber']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($currentUser['email']); ?>" required>

        <label for="password">New Password</label>
        <input type="password" name="password">

        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" name="confirmPassword">

        <input type="submit" value="Update">
    </form>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>