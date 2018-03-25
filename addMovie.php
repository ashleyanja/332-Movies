<?php
// Add movie 
session_start();
include 'dbLogin.php';
print_r($_POST);
$title = $_POST['title'];
$runtime = $_POST['runtime'];
$production = $_POST['production'];
$supplier = $_POST['distributor'];
$rating = $_POST['rating'];
$actors = $_POST['actors'];
$directors = $_POST['directors'];
$plot = $_POST['plot'];
echo "aaa {$_POST['title']} aaa";

// check if movie already exist
$db = DBLogin();
$sql = "SELECT * FROM movie WHERE title = '$title'";
echo $sql;
$result = $db->query($sql);
  	if ($result->num_rows > 0)
  	{
  		// movie exists
  		echo"<h1>Movie: {$title} is already in the database</h1>";
		echo "<a href='admin.php'>Click here to return back to the control panel</a>";
		exit;
  	}
// add movie
  	echo "<p>Move onto addition</p>";
  	$sql = "SELECT * FROM supplier WHERE  Name = '$supplier'";

	$result = $db->query($sql);

  	if ($result->num_rows == 0)
  	{
  		//Add the supplier 
  		$sql = "INSERT INTO supplier (Name) VALUES ('$supplier')";
  		$db->query($sql);
  	}
  	// supplier in db move on
  	$sql = "INSERT INTO movie (Title,RunTime,Plot,Supplier,Production,Rating) 
  			VALUES ('$title','$runtime','$plot','$supplier','$production','$rating')";
  	if ($db->query($sql) === TRUE) 
  	{
    	echo "Movie added successfully";
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $db->error;
	}

	// add directors and actors 
	$actors =explode(",", $actors);
	$directors = explode(",", $directors);

	foreach ($actors as $x)
	{
		$name = split_name($x);
		$fname = $name[0];
		$lname = $name[1];
		$sql = "INSERT INTO actors (Title,Fname,Lname) VALUES ('$title', '$fname', '$lname')";
		$db->query($sql);
	}
	foreach ($directors as $x)
	{
		$name = split_name($x);
		$fname = $name[0];
		$lname = $name[1];
		$sql = "INSERT INTO directors (Title,Fname,Lname) VALUES ('$title', '$fname', '$lname')";
		$db->query($sql);
	}


	function split_name($name) 
	{
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
    return array($first_name, $last_name);
    }
?>