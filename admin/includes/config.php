<?php 
session_start();

date_default_timezone_set("Asia/Calcutta");

$db_host = "localhost";
// Place the username for the MySQL database here
$db_username = "root"; 
// Place the password for the MySQL database here
$db_pass = "";
// Place the name for the MySQL database here
$db_name = "prem_assignment_db";

$conDB = mysqli_connect($db_host,$db_username,$db_pass,$db_name)or die('Error: Could not connect to database.');
$connect = new PDO("mysql:host=$db_host; dbname=$db_name", "$db_username", "$db_pass");
error_reporting(0);

?>