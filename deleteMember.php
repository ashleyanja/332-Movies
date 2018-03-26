<?php
//Delete User
session_start();
include "dbLogin.php";
$db = DBLogin();
$member = $_POST['member'];
// delete reviews and movies

$sql ="DELETE FROM review where AccountNumber = {$member}";
$db -> query($sql);
$sql ="SELECT * FROM reservation where AccountNumber = {$member}";

$result = $db->query($sql);
    if ($result->num_rows > 0) 
    {
      // output data of each row
      $row = $result->fetch_assoc();
      print_r($row);
      $id = $row['AccountNumber'];
      $complex = $row['Complex']; 
      $theatre = $row['Theatre'];
      $time = $row['StartTime'];
      $day = $row['Day'];
      $numTickets = $row['NumTickets'];
      $sql = "SELECT NumSeats FROM showing where Complex = '{$complex}' AND Theatre = '{$theatre}' AND StartTime = '{$time}' AND Day = '{$day}' ";
      $res = $db -> query($sql);
      if ($res->num_rows > 0) 
      {
      	// output data of each row
      	$row = $res->fetch_assoc();
      	$oldSeats = $row['NumSeats'];
      	$newSeats = $oldSeats + $numTickets;
      	$sql = "UPDATE showing SET numseats='$newSeats' where Complex = '{$complex}' AND Theatre = '{$theatre}' AND StartTime = '{$time}' AND Day = '{$day}' ";
      	$db -> query($sql);
      }
      $sql = "DELETE FROM reservation where AccountNumber = {$member}";
      $db -> query($sql);
    }


$sql ="DELETE FROM customer where AccountNumber = {$member}";
echo "$sql";

if($db->query($sql)) // will return true if succefull else it will return false
{
	echo "Account {$_POST['member']} was succefully deleted";
}
else
{
	echo "Error deleting Account";
}
// Add more to this page if able to 
?>