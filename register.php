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
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $role = "user";

    if ($user->register($name, $surname, $phoneNumber, $email, $password, $confirmPassword, $role)) {

        echo "Regjistrimi u krye me sukses!";
    } else {
        echo "Regjistrimi deshtoi.Provo perseri!";
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
  <section id="login">
  <!-- REGISTER FORM -->
   <div class="register-container">
    <img src="images/Logo.png" alt="Alora Logo">
    <script src="script.js"></script>
    <form id="registerForm" onsubmit="return validateRegisterForm()" method="POST" action="">
      <input type="text" name="name" id="registerName" placeholder="Name" required>
      <br>
      <input type="text" name="surname" id="registerSurname" placeholder="Surname" required>
      <br>
      <input type="tel" name="phoneNumber" id="registerPhoneNumber" placeholder="Phone Number" required>
      <br>
      <input type="email" name="email" id="registerEmail" placeholder="E-mail" required>
      <p id="errorMessage" style="color: red;"></p>
      <input type="password" name="password" id="registerPassword" placeholder="Type your password" required>
      <br>
      <p id="confirmErrorMessage" style="color: red;"></p>
      <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password" required>
      <br>
      <input type="submit" name="submit" value="Sign up" id="submit">
    </form>
   </div>
  </section>
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