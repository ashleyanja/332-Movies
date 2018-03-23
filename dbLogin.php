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
?>