<?php
session_start();

if(isset($_SESSION['uname']))
{
    session_destroy();
    header("Location:./");
    
}else
{
    header("Location:./");
}
?>