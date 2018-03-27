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

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: BizPage
    Theme URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

<!--==========================
  Intro Section
============================-->

<section id="ThankYouReview"  class="section-bg" >
  <div class="container">

    <header class="section-header">
      <br><br>
      <h3 class="section-title">Your purchases:</h3>
    </header>
    <p style='text-align:center'><a href='/login.php'>Return Home</a></p>
 </body>

<?php
include "dbLogin.php";
$db = DBLogin();

$account = (int)$_SESSION["accountNumber"];

/*UPCOMING MOVIES ------------------------------------------------------------------------------------*/
echo "<h3 >Upcoming Movies</h3>";
$q = "SELECT * FROM `reservation` WHERE `Day` >= CURDATE()";
$result = $db->query($q);  
if ($result && $result->num_rows > 0) {
  // output data of each row
   echo "<table class='t1'>
            <thead>
            <tr>
               <th>Complex</th>
               <th>Theatre</th>
               <th>Start Time</th>
               <th>Day</th>
               <th>Tickets</th>
            </tr>
            </thead>
          ";
    while($row = $result->fetch_assoc()) {
      echo "<tbody>";
      echo "<tr>";
      echo "<td>" . $row["Complex"] . "</td>";
      echo "<td>" . $row["Theatre"] . "</td>";
      echo "<td>" . $row["StartTime"] . "</td>";
      echo "<td>" . $row["Day"] . "</td>";
      echo "<td>" . $row["NumTickets"] . "</td>";
      echo "</tr>";
      echo "</tbody>";
      }
    echo "</table>";
    } else {
        echo "<p style='text-align:center;'>You have no upcoming movie reservations!</p>";
    }

/*PAST MOVIES ------------------------------------------------------------------------------------*/
echo "<h3 >Past Movies</h3>";
$q = "SELECT * FROM `reservation` WHERE `Day` <= CURDATE()";
$result = $db->query($q);  
if ($result && $result->num_rows > 0) {
  // output data of each row
   echo "<table class='t1'>
            <thead>
            <tr>
               <th>Complex</th>
               <th>Theatre</th>
               <th>Start Time</th>
               <th>Day</th>
               <th>Tickets</th>
            </tr>
            </thead>
          ";
    while($row = $result->fetch_assoc()) {
      echo "<tbody>";
      echo "<tr>";
      echo "<td>" . $row["Complex"] . "</td>";
      echo "<td>" . $row["Theatre"] . "</td>";
      echo "<td>" . $row["StartTime"] . "</td>";
      echo "<td>" . $row["Day"] . "</td>";
      echo "<td>" . $row["NumTickets"] . "</td>";
      echo "</tr>";
      echo "</tbody>";
      }
    echo "</table>";
    } else {
        echo "<p style='text-align:center;'>You have no past movie reservations!</p>";
    }
$db->close();
?>

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

</body>
</html>