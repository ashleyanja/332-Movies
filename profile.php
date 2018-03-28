<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Movies for You</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="https://image.flaticon.com/icons/png/512/184/184578.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link href= "css/movie.css" rel="stylesheet">
  <link href= "css/admin.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: BizPage
    Theme URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>
<br><br><br><br>
<body>
<?php

// can access without having to log back in 
if(!(array_key_exists('login',$_SESSION) && $_SESSION['login']))
{
  echo"you are not logged in";
  exit;
 

}
  include "dbLogin.php";
  $db = DBLogin();
  $admin = $_SESSION['admin'];
  echo "<h1>Profile for {$_SESSION['fname']}</h1>";
  $id = $_SESSION['accountNumber'];
  $sql = "SELECT * FROM customer WHERE AccountNumber = {$id}";
  $result = $db->query($sql);
    if ($result->num_rows > 0) 
  {
    while($row = $result->fetch_assoc()) 
    {
      $pw = $row['Password'];
      $phone = $row['PhoneNumber'];
      $fname = $row['Fname'];
      $lname = $row['Lname'];
      $email = $row['Email'];
      $cc = $row['CreditCardNum'] ;
      $ccExp = $row['CreditCardExp'];
    }
  }
  echo "<h3>Update Info</h3>";
  echo "
  <form action = 'updateProfile.php' method = 'post'>
  <input type = 'text' name = 'password' placeholder = 'Password'>

  <input type = 'text' name = 'fname' placeholder = 'First Name' value = '{$fname}' required>

  <input type = 'text' name = 'lname' placeholder = 'Last Name' value = '{$lname}' required>

  <input type = 'email' name = 'email' placeholder = 'Email' value = '{$email}' required>

  <input type = 'number' name = 'phone' placeholder = 'Phone Number' value = '{$phone}' required>

 <input type = 'number' name = 'cc' placeholder = 'cc' value = '{$cc}'>
  <p>Experiation Date </p> <input type = 'date' name = 'exp' value = '{$ccExp}'>
   <input type = 'hidden' name = 'id' value = '{$id}'>
   <input type = 'hidden' name = 'ogCC' value = '{$cc}'>
   <input type = 'hidden' name = 'ogPW' value = '{$pw}'>
   <input type = 'submit' value = 'update info'>
  </form>
  "
?>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto">Movies For You</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#movie">Movies</a></li>
          <li class="menu-has-children"><a href="">My Account</a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="#">My Movies</a></li>
            </ul>
          </li> 
          <?php 
            if($admin)
            {
              echo  "<li> <a href='admin.php'>Admin</a></li>";
            }

            ?>
            <li> <a href='index.php'>Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
