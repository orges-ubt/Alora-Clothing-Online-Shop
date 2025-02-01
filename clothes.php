<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alora Clothing Shop</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
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
  <main>
    <!-- CLOTHES PART -->
    <div class="clothes-container">
      <div class="clothes-box">
        <img src="images/Hugo T-shirt.png" alt="Hugo T-shirt">
        <p>Black Hugo T-shirt</p>
        <p>79.99 &euro;</p>
        <button class="clothes-button">Add to Cart</button>
      </div>
      <div class="clothes-box">
        <img src="images/Amiri Jeans.png" alt="Amiri Jeans">
        <p>Black Amiri Jeans</p>
        <p>89.99 &euro;</p>
        <button class="clothes-button">Add to Cart</button>
      </div>
      <div class="clothes-box">
        <img src="images/Polo T-shirt.png" alt="Polo T-shirt">
        <p>White & Red Strips Polo T-shirt</p>
        <p>89.99 &euro;</p>
        <button class="clothes-button">Add to Cart</button>
      </div>
      <div class="clothes-box">
        <img src="images/Amiri Hoodie.png" alt="Amiri Hoodie">
        <p>Galaxy Amiri Hoodie</p>
        <p>109.99 &euro;</p>
        <button class="clothes-button">Add to Cart</button>
      </div>
      <div class="clothes-box">
        <img src="images/Hugo Sweater.png" alt="Hugo Sweater">
        <p>Black Hugo Sweater</p>
        <p>119.99 &euro;</p>
        <button class="clothes-button">Add to Cart</button>
      </div>
      <div class="clothes-box">
        <img src="images/North Face Jacket.png" alt="The North Face Jacket">
        <p>The North Face Puffer Jacket</p>
        <p>149.99 &euro;</p>
        <button class="clothes-button">Add to Cart</button>
      </div>
      <div class="clothes-box">
        <img src="images/Diesel Jeans.png" alt="Diesel Jeans">
        <p>Light Blue Diesel Jeans</p>
        <p>99.99 &euro;</p>
        <button class="clothes-button">Add to Cart</button>
      </div>
      <div class="clothes-box">
        <img src="images/Lacoste Sweater.png" alt="Lacoste Sweater">
        <p>Black Lacoste Sweater</p>
        <p>129.99 &euro;</p>
        <button class="clothes-button">Add to Cart</button>
      </div>
    </div>
  </main>
  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-container">
      <div class="social">
        <a href="https://facebook.com">
          <img src="images/social-facebook.svg" alt="Facebook" />
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