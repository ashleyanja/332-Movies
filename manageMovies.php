<?php
//
session_start();
include 'dbLogin.php';
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
    Intro Section
  ============================-->
  <br><br><br><br><br>
  
	<H1>Manage Movies</H1>
<?php
	/* iterate through and select names and emails */
$db = DBLogin();
$sql = "SELECT title, runtime, plot, production, rating from movie";
$result = $db->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    echo "<table class='t1'>
            <thead>
            <tr>
                <th>Title</th>
                <th>Runtime</th>
                <th>Plot</th>
                <th>Production</th>
                <th>Rating</th>
            </tr>
            </thead>
          ";
    while($row = $result->fetch_assoc()) {
      echo "<tbody>";
      echo "<tr>";
      echo "<td>" . $row["title"] . "</td>";
      echo "<td>" . $row["runtime"] . "</td>";
      echo "<td>" . $row["plot"] . "</td>";
      echo "<td>" . $row["production"] . "</td>";
      echo "<td>" . $row["rating"] . "</td>";
      echo "</tr>";
      echo "</tbody>";
      }
    echo "</table>";
    } else {
        echo "0 results";
    }
  $db->close();
?>

<h3>Add a new Movie</h3>
<form action="addMovie.php"  method="post">
    <input type="text" name="title" id="title" placeholder="Title">
    <input type="number" name="year" id="year" min = "1900" max ="2018" placeholder="Year" required>
    <input type="number" name="runtime" id="runtime" min="0" max ="" placeholder="Runtime" required >
    <br>

    <input type="text" name="production" id="production" placeholder="Production Company" required>
    <input type="text" name="distributor" id="distributor" placeholder="Distributor" required>
    <select name="rating" id = "rating" required>
            <option value="G">G</option>
            <option value="PG">PG</option>
            <option value="14A">14A</option>
            <option value="18A">18A</option>
            <option value="18A">R</option>
    </select>
    <br>

    <textarea name="actors" id="actors" rows="7" cols="22" placeholder="Actors(Seperate names with ,)" required></textarea>
    <textarea name="directorst" id="directors" rows="7" cols="22" placeholder="Directors(Seperate names with ,)" required></textarea>
    <textarea name="plot" id ="plot" rows="7" cols="22" placeholder="Plot(max 1000 characters)" required></textarea>
    <br>
    <input type="submit" value="Add Movie">
  
</form>
	
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
