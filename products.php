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
    <li> <a href="shopping.php"><svg width="33px" height="33px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="shopping-bag">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
    </svg>
  </a></li>
    </ul>
      
     
  </nav>
  <main>
  <!-- CLOTHES SHOPPING -->
   <div class="clothes">
    <p>Hurry up!Limited-edition pieces are rapidly solding out,come and get your favourite piece of style.</p>
    <a href="clothes.php"><button class="buy-clothes">Shop now</button>
    </a>
   </div>
   <!-- SHOES SHOPPING -->
   <div class="shoes">
    <p>If you are a shoe hype beast,we know a great place for shoes shopping.</p>
    <a href="shoes.php">
    <button class="buy-shoes">Shop now</button>
  </a>
   </div>
   <!-- SALE PART -->
   <div class="sale">
    <p>Fall 2024-Continue to look good,20% sale for every new customer that signs up.</p>
    <a href="register.php">
    <button class="sale-button">Register now</button>
    </a>
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