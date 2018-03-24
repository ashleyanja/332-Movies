<?php
// Add movie 
session_start();
include 'dbLogin.php';
print_r($_POST);
echo "aaa {$_POST['title']} aaa";
?>