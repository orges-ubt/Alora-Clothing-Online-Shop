<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alora Clothing Shop</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "user.php";

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($user->login($email, $password)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Te dhenat jane gabim!";
    }   
}
?>
   <!-- NAVIGATION BAR -->
   <nav class="navbar">
    <div id="nav-logo">
      <a href="index.php"><img src="images/logo.png" alt="Alora Logo"></a>
    </div>
    <div class="nav-ul">
    <ul>
    <?php
            if (isset($_SESSION['user_id'])) {
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    echo '<li id="dashboard"><a href="dashboard.php">Dashboard</a></li>';
                }
            }
            ?>
      <li><a href="index.php">Home</a></li>
      <li><a href="products.php">Products</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="login.php"><svg width="33px" height="33px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="user">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
      </svg>
    </a></li>
    <?php
    if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] !== 'admin') {
      echo '<li><a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="user">
      <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
    </svg></a></li>';
    }
}
    ?>
    </ul>
</div>
  </nav>
  <section id="login">
  <!-- LOG IN FORM -->
   <script src="script.js"></script>
   <div class="login-container">
    <img src="images/Logo.png" alt="Alora Logo">
    <form id="loginForm" onsubmit="return validateLoginForm()" action="" method="POST">
      <input type="text" name="email" placeholder="Type your username" id="loginUsername" required>
      <br>
      <p id="errorMessage" style="color: red;"></p>
      <input type="password" name="password" placeholder="Type your password" id="loginPassword" required>
      <br>
      <input type="submit" value="Log in" id="submit">
      <p>Don't have an account?Sign up below:</p>
    </form>
    <a href="register.php">
      <input type="submit" value="Sign up" id="submit">
    </a>
   </div>
  </section>
  <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo '<a href="dashboard.php"><button>Dashboard</button></a>';
    }
    ?>
  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-container">
      <div class="social">
        <a href="https://facebook.com">
          <img src="images/social-facebook.svg" alt="Facebook"/>
        </a>
        <a href="https://instagram.com">
          <img src="images/social-instagram.svg" alt="Instagram" />
        </a>
        <a href="https://youtube.com">
          <img src="images/social-youtube.svg" alt="Youtube" />
        </a>
      </div>
      <p>© 2024 Alora Clothing. All rights reserved.</p>
      <p><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="location">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
      </svg>
      Peja,Kosovo 30000</p>
    </div>
  </footer>
</body>
</html>