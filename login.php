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

// can access without having to log back in 
if(!(array_key_exists('login',$_SESSION) && $_SESSION['login']))
{
  // first log in
  // page state variables
  $admin = false;
  // try to login
  //$username = 10183354;
  $username = $_POST["accountNumber"];
  $password = $_POST["password"];
  $sql = "SELECT Fname,Password,isAdmin from customer where accountNumber =".$username;
  $db = DBLogin();

    $result = $db->query($sql);
    if ($result->num_rows > 0) 
    {
      // output data of each row
      $row = $result->fetch_assoc();
      $name = $row['Fname'];
      $pw = $row['Password'];
      
      if($password == $pw)
      {
        // login
        $admin = $row['isAdmin'];
      }
      else
      {
         header('Location: error.php#login');
      }
    }
     else 
    {
    
          header('Location: error.php#login');
    
  }
  $db -> close();
  // Save values to the session
  $_SESSION["fname"] = $name; 
  $_SESSION['admin'] = $admin; // bool T if user is an admin
  $_SESSION['accountNumber'] = $username;
  $_SESSION['login'] = true;
}
else
{
  $admin = $_SESSION['admin'];
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
          <li><a href="#movie">Movies</a></li>
          <li class="menu-has-children"><a href="">My Account</a>
            <ul>
              <li><a href="#">Profile</a></li>
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

  <!--==========================
    Intro Section
  ============================-->

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
                <a href="#login" class="btn-get-started scrollto">View Account</a>
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
        <table>
        <tr>
        <td><h4 style="text-align:left;">Find a Showing: </h4></td>

<?php

/*FIND SHOWINGS--------------------------*/
    $db = DBLogin();
    $sql = "SELECT cname, city from complex";
    $result = $db->query($sql);
    echo 
      "<td><form action='showingsLogin.php.php' method='get'>
      <select name='TheatreComplex'>";
    $ComplexName = "cname";
    $City = "city";
    while($row = $result->fetch_assoc()) {
      echo '<option value="'.$row[$ComplexName].'">' . $row[$ComplexName] . '</option>'; 
    }
    echo "</select>";
    echo 
      "<input type='submit' value='GO!'>
      </form></td>";
/*FIND SHOWINGS----------------------*/

?>

</tr>
</table>
        
<?php
/* DISPLAY MOVIES--------------*/
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
/*DISPLAY MOVIES------------------*/
?>

<!--===========BEGIN WRITE A REVIEW============-->
<button onclick="document.getElementById('modal-wrapper').style.display='block'" style="text-align:center;">
Review a Movie</button>

<div id="modal-wrapper" class="modal" style="text-align:center; color:white;"">
  
  <!--NOTE: need to add action to form-->
  <form class="modal-content animate" method="post" action="addReview.php" style="background-color: #1a1a1a;">
        
    <div class="imgcontainer">
      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
      <img src="img/movieReview.jpg" alt="Movie Review" class="avatar">
      <h1>Review a Movie</h1>
    </div>

    <div id="reviewContainer" class="container">
      <select name="reviewingMovie" class="form-control">
        <?php
          $sql = "SELECT title FROM movie";
          $result = $db->query($sql);      
          while($row = $result->fetch_assoc()) {
            $Movie = $row["title"];
            echo "<option value='".$Movie."'>".$Movie."</option>";
          }
          $db->close();
        ?>
      </select>
    </div>

    <div class="container">
      <fieldset class="rating">
        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
        <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
      </fieldset>  
    </div>

    <input type="submit" value="Rate"></input>
    
  </form>
</div>
<!--===========END WRITE A REVIEW============-->

</div>
</section>

  <!--==========================
   Display Movie Reviews Section
  ============================-->
    <section id="testimonials" class="section-bg wow fadeInUp">
      <div class="container">

        <header class="section-header">
          <h3>Movie Reviews</h3>
        </header>

        <div class="owl-carousel testimonials-carousel">

          <div class="testimonial-item">
            <img src="img/testimonial-1.jpg" class="testimonial-img" alt="">
            <h3>Saul Goodman</h3>
            <h4>Ceo &amp; Founder</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

          <div class="testimonial-item">
            <img src="img/testimonial-2.jpg" class="testimonial-img" alt="">
            <h3>Sara Wilsson</h3>
            <h4>Designer</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

          <div class="testimonial-item">
            <img src="img/testimonial-3.jpg" class="testimonial-img" alt="">
            <h3>Jena Karlis</h3>
            <h4>Store Owner</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

          <div class="testimonial-item">
            <img src="img/testimonial-4.jpg" class="testimonial-img" alt="">
            <h3>Matt Brandon</h3>
            <h4>Freelancer</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

          <div class="testimonial-item">
            <img src="img/testimonial-5.jpg" class="testimonial-img" alt="">
            <h3>John Larson</h3>
            <h4>Entrepreneur</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

        </div>

      </div>
    </section><!-- #testimonials -->


    <!--==========================
      Login Section
    ============================-->

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
