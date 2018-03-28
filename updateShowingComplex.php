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
  <link href= "css/admin.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <link href= "css/movie.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: BizPage
    Theme URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>
<?php
	if(!array_key_exists('admin',$_SESSION) || !$_SESSION['admin'])
	{
		echo "Access Denied";
		exit;
	} 
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
          <li><a href="login.php">Movies</a></li>
          <li class="menu-has-children"><a href="">My Account</a>
            <ul>
              <li><a href="#">Profile</a></li>
              <li><a href="#">My Movies</a></li>
            </ul>
          </li> 
          <?php 
            if($_SESSION['admin'])
            {
              echo  "<li> <a href='admin.php'>Admin</a></li>";
            }
            ?>
            <li> <a href='index.php'>Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Showings Section
    - should be able update where/when movies are showing
  ============================-->
  <section id="updateShowing" class="section-bg"">
  <br><br><br><br><br>
      <?php
      include "dbLogin.php";
      $db = DBLogin();
      $string = $_POST["updateComplex"];
      $array = explode("|" , $string);

      $updateTheatre = (int)$array[0];
      $updateComp = $array[1];
      $updateTime = $_POST["addTime"];
      $updateDay = $_POST["addDay"];
      $Day = $array[2];
      $Time = $array[3];
      $TheatreNum = (int)$array[4];
      $complex = $array[5];
      $NumSeats = (int)$array[6];

      // Store users with reservations in an array
      $flag = FALSE; 
      $q = "SELECT AccountNumber, NumTickets
              FROM reservation 
              WHERE Day = '$Day'
              AND StartTime = '$Time'
              AND Complex = '$complex'
              AND Theatre = '$TheatreNum'";
      $resultq = $db->query($q);
      while ($row = $resultq -> fetch_assoc()){
        $accounts[] = $row['AccountNumber'];
        $tics[] = $row['NumTickets'];
        $flag = TRUE;
      }

      /*Update Showing*/
      $sql1 = "UPDATE showing
              SET Complex = '$updateComp', Theatre = '$updateTheatre', Day = '$updateDay', StartTime = '$updateTime'
              WHERE Day = '$Day'
              AND StartTime = '$Time'
              AND Complex = '$complex'
              AND Theatre = '$TheatreNum'";

      /*Delete User Reservations for this showing*/
      $sql2 = "DELETE FROM reservation
              WHERE Day = '$Day'
              AND StartTime = '$Time'
              AND Complex = '$complex'
              AND Theatre = '$TheatreNum'";


      if ($db->query($sql2) == TRUE) {}
      else {
        echo "Error: " . $sql2 . "<br>" . $db->error;
      }
      if ($db->query($sql1) == TRUE) {
        echo "<p>Showing successfully updated!</p>";
      }
      else {
        echo "Error: " . $sql1 . "<br>" . $db->error;
      }
      if ($flag)
      {
      for ($x = 0; $x < sizeof($accounts); $x++) {
        $q2 = "INSERT INTO reservation (AccountNumber, Complex, Theatre, StartTime, Day, NumTickets)
               VALUES ($accounts[$x], '$updateComp', $updateTheatre, '$updateTime', '$updateDay', $tics[$x])";
        if ($db->query($q2) == TRUE){
          echo "<p>Reservation successfully restored!</p>";
        }
        else {
          echo "Error: " . $q2 . "<br>" . $db->error;
        }
      }// end for loop
      }//end if flag
      
      $db->close();
      ?>
</section>
</body>

	
  <!--==========================
    Footer
  ============================-->
  <footer id="footer">

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>BizPage</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
        -->
        Best <a href="https://bootstrapmade.com/">Bootstrap Templates</a> by BootstrapMade
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</html>
