<?php
session_start();
include "dbLogin.php";
$db = DBLogin();

var_dump($_POST);

if (isset($_POST["reviewingMovie"])) {
    echo "Yes, revireingMovie is set";
    $account = (int)$_SESSION["accountNumber"];
	$movie = $_POST['reviewingMovie'];
	$rating = (int)$_POST['rating']; 
	$q = "INSERT INTO review (AccountNumber, Movie, Review) VALUES ('$account', '$movie', '$rating')
	ON DUPLICATE KEY UPDATE
	Review='$rating'";

	if ($db->query($q) == TRUE){
		echo "<p>Successs</p>";
	}
	else {
		echo "Error: " . $q . "<br>" . $db->error;
	}   

}else {  
    echo "N0, reviewingMovie is not set";
}

$db->close();
?>