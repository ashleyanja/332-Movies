<?php
// Add movie 
session_start();
include 'dbLogin.php';
//print_r($_POST);
//echo "{$_POST['complex']}";
$db = DBLogin();
$sql = "INSERT INTO Theatre (TheatreNum, Complex, ScreenSize, MaxSeats) 
		VALUES ({$_POST['number']},'{$_POST['complex']}','{$_POST['size']}',{$_POST['Seats']})";
//echo "$sql";
if($db -> query($sql))
{
	echo "<h1>Theatre {$_POST['number']} succesfully added!</h1>";
}
else
{
	echo "<h1>Error adding theatre to database</h1>";
}
?>