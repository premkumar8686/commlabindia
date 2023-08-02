<?php
include_once("../admin/includes/config.php");


    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $gender = $_POST['gender'];
    $colours = $_POST['colours'];
    $confirm_password = $_POST['confirm_password'];

    $username_f = strtolower(str_replace(' ', '_', $username));

    $b64_log_pass = base64_encode($confirm_password);

    $date = date("Y-m-d");

    $colours_final = implode(",",$_POST['colours']);

    $registration_select = "INSERT INTO `users` (`user_name`, `first_name`, `last_name`, `email`, `gender`, `favourite_colours`, `password`, `date`) VALUES ('$username_f', '$first_name', '$last_name', '$email_address', '$gender', '$colours_final', '$b64_log_pass', '$date');";

    $registration_query = mysqli_query($conDB,$registration_select);
 
   echo 1;
?>