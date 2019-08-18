<?php
session_start();
include ('config.php');
?>

<html lang="en">
<head>
  <title>Vendorly</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="styles.css">

</head>

<body>


  <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #866ec7;">
      <a href="home.php" class="navbar-brand">Vendorly</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCustom">
          <i class="fa fa-bars fa-lg py-1 text-white"></i>
      </button>
      <div class="navbar-collapse collapse" id="navbarCustom">
          <ul class="navbar-nav mr-auto">

          </ul>
          <ul class="navbar-nav">
              <?php
                if(isset($_SESSION['user'])) {
                  echo '<a class="nav-link" href="shipment.php">New Shipment</a>
                  <a class="nav-link" href="logout.php">Logout</a>
                  ';
                } else {
                  echo '<a class="nav-link" href="login.php">Login</a>
                  <a class="nav-link" href="register.php">Register</a>';
                }

               ?>


          </ul>


      </div>
  </nav>
  <?php
  if(!empty($_SESSION['success'])) {
     echo '<div class="alert alert-success alert-dismissible" style="position:absolute; width: 100%; z-index:1000000;">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>'.$_SESSION['success'].'</strong>
          </div>';
     // Unset session message so that it only appears once
     unset($_SESSION['success']);
  }
  if(!empty($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible" style="position:absolute; width: 100%; z-index:1000000;">
                <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>'.$_SESSION['error'].'</strong>
              </div>';
    unset($_SESSION['error']);
  }
   ?>
