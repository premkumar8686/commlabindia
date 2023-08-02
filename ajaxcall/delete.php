<?php 
include_once("../admin/includes/config.php");

$remove_id = $_POST['remove_id'];

  
$delete_number = "UPDATE `users` SET `isactive` = '0' WHERE `users`.`id` = $remove_id";
  
mysqli_query($conDB,$delete_number);

echo $remove_id;

?>