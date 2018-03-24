<?php
// Add movie 
session_start();
include 'dbLogin.php';
print_r($_POST);
$title = $_POST['title'];
$year = $_POST['year'];
$runtime = $_POST['runtime'];
$production = $_POST['production'];
$supplier = $_POST['distributor'];
$rating = $_POST['rating'];
$actors = $_POST['actors'];
$directors = $_POST['directors'];
$plot = $_POST['plot'];
echo "aaa {$_POST['title']} aaa";
?>