<?php
//Delete User
session_start();
include "dbLogin.php";
$db = DBLogin();
$sql ="DELETE FROM customer where AccountNumber = {$_POST['member']}";

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