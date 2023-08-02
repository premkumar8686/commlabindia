<?php
include_once("../admin/includes/config.php");

$username = $_POST['username'];

$username_f = strtolower(str_replace(' ', '_', $username));

$select = "SELECT * FROM `users` WHERE `user_name` = '$username_f'";

$log_query = mysqli_query($conDB,$select);

$count = mysqli_num_rows($log_query);

if($count === 0) 
{
    $result = 0;
} else {
    $result = 1;
}

echo $result;

?>