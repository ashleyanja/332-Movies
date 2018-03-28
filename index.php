
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
          <li><a href="#login">Login</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
<?php

function DBLogin()
{
  $host = "localhost";
  $user = 'root';
  $pass = '';
  $db = 'moviedb';

  $db = new mysqli($host, $user, $pass, $db) or die("Unable to connect");
  if ($db->connect_error) {die("Connection failed: " . $db->connect_error);}
  return $db;
}
// user is logged out
 session_unset();
 session_destroy();
 
?>
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item active">
            <div class="carousel-background"><img src="img/MovieSlide.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>MOVIES MOVIES MOVIES</h2>
                <p> Find the BEST movies here</p>
                <a href="#login" class="btn-get-started scrollto">Login</a>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/TammySlide.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Tammy and the T-Rex</h2>
                <p>This Weeks Special Feature Picture</p>
                <a href="#movie" class="btn-get-started scrollto">Browse Movies</a>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      Movie Section
    ============================-->
    <section id="movie"  class="section-bg" >
      <div class="container">

        <header class="section-header">
          <br><br>
          <h3 class="section-title">Our Movies</h3>
        </header>
<?php
/* iterate through and select names and emails */
$db = DBLogin();
$sql = "SELECT title, runtime, plot, production, rating from movie";
$result = $db->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    // add actors

    echo "<table class='t1'>
            <thead>
            <tr>
                <th>Title</th>
                <th>Actors</th>
                <th>Directors</th>
                <th>Runtime</th>
                <th>Plot</th>
                <th>Production</th>
                <th>Rating</th>
                <th>Score</th>
            </tr>
            </thead>
          ";
    while($row = $result->fetch_assoc()) {

      $sql = "SELECT SUM(review) as score, COUNT(review) as n from review where movie = '{$row['title']}'";
      $res = $db->query($sql);
       if ($res->num_rows > 0) 
       {
          $r = $res->fetch_assoc();  
          if($r['n'] == 0)
          {
            $score = "n/a";
          } 
          else
          {
            $score = $r['score'] / $r['n'];
          }
       }
       $actors  = '';
       $sql = "SELECT * from Actors where title = '{$row['title']}'";
       //echo "$sql";
      $res = $db->query($sql);
       if ($res->num_rows > 0) 
       {
          while($r = $res->fetch_assoc())
          {
            $name = $r['Fname'] . " " . $r['Lname'] . ", ";
            $actors = $actors . $name;
          }  
         
       }
       $dir = '';

      $sql = "SELECT * from Directors where title = '{$row['title']}'";
      $res = $db->query($sql);
       if ($res->num_rows > 0) 
       {
          while($r = $res->fetch_assoc())
          {
            $name = $r['Fname'] . " " . $r['Lname'] . ", ";
            $dir = $dir . $name;
          }  
         
       }




      echo "<tbody>";
      echo "<tr>";
      echo "<td>" . $row["title"] . "</td>";
       echo "<td>" . $actors . "</td>";
        echo "<td>" . $dir . "</td>";
      echo "<td>" . $row["runtime"] . "</td>";
      echo "<td>" . $row["plot"] . "</td>";
      echo "<td>" . $row["production"] . "</td>";
      echo "<td>" . $row["rating"] . "</td>";
      echo "<td>" . $score . "</td>";
      echo "</tr>";
      echo "</tbody>";
      }
    echo "</table>";
    } else {
        echo "0 results";
    }
  $db->close();
?>

<p style='text-align:center'><a href='#login'>Login to find showings and purchase tickets!</a></p>
        

    <!--==========================
      Login Section
    ============================-->
    <section id="login" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Login</h3>
          <p>Please log into your account here</p>
        </div>

      <!-- contact info -->
        <div class="form">
          <form action="login.php" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="accountNumber" class="form-control" id="accountNumber" placeholder="accountNumber" required />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="password" class="form-control" name="password" id="password" placeholder="password" required/>
                <div class="validation"></div>
              </div>
            <div class="text-center"><button type="submit">Login</button></div>
            <br>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

     <section id="login" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Create An Account</h3>
          <p>Please make your account here</p>
        </div>

      <!-- contact info -->
        <div class="form">
          <form action="createAccount.php" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="number" name="accountNumber" class="form-control" id="accountNumber" placeholder="Account Number(Max of 9 digits)" min = "0" max="999999999" required />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="password" class="form-control" name="password" id="password" placeholder="password" required/>
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required/>
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required/>
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required/>
                <div class="validation"></div>
              </div>
            <div class="text-center"><button type="submit">Create Account</button></div>
            <br>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

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
