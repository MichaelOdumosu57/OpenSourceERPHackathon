<?php
require('navbar.php');
?>

  <div class="container text-center home-main-container" style="margin-top: 180px;">
    <h1 style="font-variant: small-caps;">Welcome to Vendorly</h1>
    <span style="font-variant: small-caps;">Vendor Compliance Made Easy</span><br><br>
    <?php
    if(!isset($_SESSION['user'])) {
      echo '<a class="btn" href="login.php">Login</a>
      <a class="btn" href="register.php">Register</a>
      ';
    }

     ?>

  </div>
