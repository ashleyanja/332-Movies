<?php
// Add movie 
session_start();
include 'dbLogin.php';
//print_r($_POST);

$db = DBLogin();
$sql = "INSERT INTO Complex (CName, PhoneNumber, Street, City, PostalCode) 
		VALUES ('{$_POST['name']}',{$_POST['phone']},'{$_POST['street']}','{$_POST['city']}','{$_POST['postal']}')";
//echo "$sql";
if($db -> query($sql))
{
	echo "<h1>Complex, {$_POST['name']} , succesfully added!</h1>";
}
else
{
	echo "<h1>Error adding complex to database</h1>";
}
?>