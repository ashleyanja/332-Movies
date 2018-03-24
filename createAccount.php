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
<?php
// clean up values
	include 'dbLogin.php';
	$accountNumber = $_POST['accountNumber'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$Fname = $_POST['fname'];
	$Lname = $_POST['lname'];
	// ensure account number is a number
	if(!(is_numeric($accountNumber)))
	{
		echo"<h1>Account Number: {$accountNumber} is not valid</h1>";
		echo "<a href='index.php'>Click here to return back to the main page</a>";
		exit;
	}
	$sql = "SELECT accountNumber from customer where accountNumber =".$accountNumber;
	$db = DBLogin();

  	$result = $db->query($sql);
  	if ($result->num_rows > 0)
  	{
  		// account number in use
  		echo"<h1>Account Number: {$accountNumber} has already been taken</h1>";
		echo "<a href='index.php'>Click here to return back to the main page</a>";
		exit;
  	} 
  	// good to make the account
  	$sql = "INSERT INTO customer (AccountNumber,Password,Fname,Lname,Email,isAdmin) 
  			VALUES ($accountNumber,'$password','$Fname','$Lname','$email',0)";


  	if ($db->query($sql) === TRUE) 
  	{
    	echo "Account created successfully ";
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $db->error;
	}
	echo "<a href='index.php'>Click here to return back to the main page</a>";
?>
<body>


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