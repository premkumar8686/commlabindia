<?php
include_once("../admin/includes/config.php");


    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $b64_log_pass = base64_encode($password);

    $log_select = "select *from `admin` where user_name='$username' AND password='$b64_log_pass'";

    $log_query = mysqli_query($conDB,$log_select);

    if( mysqli_num_rows($log_query) == 0)
    {
        echo "0";
        exit;
    }
   else
   {
      $mysqli_log_result = $log_query -> fetch_assoc();
      $_SESSION['uname'] = $mysqli_log_result['user_name'];
      echo 1;
   }
 
   
?>