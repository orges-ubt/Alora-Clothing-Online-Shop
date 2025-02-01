<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alora Clothing Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- NAVIGATION BAR-->
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
  <!-- ABOUT US PART -->
   <div id="about-us-div">
  <h1 id="about-us-title">About Us</h1>
</div>
  <div class="aboutUs">
    <h2>Alora Clothing Shop </h2>
    <p id="aboutUs">Welcome to Alora,where fashion meets timeless elegance.We are more than just a clothing store;We're destionation for those who seek to express their individuality throught style.At Alora,we believe that clothing is a powerful form of self-expression,and our mission is to help you craft a wardrope that tells your unique story.</p>
    <h2>Our Vision</h2>
    <p id="aboutUs">To empower every individual to feel confident and inspired through fashion. We aim to be the go-to brand for modern, versatile, and high-quality clothing that fits seamlessly into your lifestyle.
    </p>
    <div class="container4">
        <div class="box1">
            <img src="images/foto9.jpg" alt="Store">
        </div>
        <div class="box1">
            <img src="images/foto10.webp" alt="Store2">
          </div>    
         <div class="box1">
            <img src="images/foto11.webp" alt="Store3">
        </div>
    </div>
    <h2>Our Story</h2>
    <p id="aboutUs">
        Founded with a passion for design and a love for all things chic, Alora was born from the idea that fashion should be accessible, inclusive, and empowering. From our humble beginnings, we have grown into a trusted name in the fashion industry, known for our commitment to quality, innovation, and exceptional customer service.
    </p>
    <h2>Our Community</h2>
    <p id="aboutUs">
        Alora is more than a brand; its a community. We take pride in fostering connections with our customers and celebrating the diverse styles and stories that make each of you unique. Follow us on social media to join the conversation, get inspired, and share your favorite Alora looks.
    </p>
    <div class="container5">
        <div class="box2">
            <img src="images/foto12.jpg" alt="Fitting Room">
        </div>
        <h3>Our Fitting Room</h3>
    </div>
    <h2>Visit Us</h2>
    <p id="aboutUs">
        Explore our latest collections online or stop by our store to experience Alora in person. We're here to help you find the perfect pieces that complement your personal style.
        Thank you for making Alora a part of your fashion journey. Together, let's redefine what it means to feel confident, beautiful, and unapologetically you.
    </p>
    <div id="text">
      <p id="text">Alora - Where Style Meets Soul.</p>
    </div>
  </div>
  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-container">
      <div class="social">
        <a href="https://facebook.com">
          <img src="images/social-facebook.svg" alt="" />
        </a>
        <a href="https://instagram.com">
          <img src="images/social-instagram.svg" alt="" />
        </a>
        <a href="https://youtube.com">
          <img src="images/social-youtube.svg" alt="" />
        </a>
      </div>
      <p>© 2024 Alora Clothing. All rights reserved.</p>
      <p><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="location">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
      </svg>
      Peje,Kosovo 30000</p>
    </div>
  </footer>
</body>
</html>