<?php
include 'connect.php';
//error_reporting(0);

setcookie("email","",time()-60);
header('location:login.php');
?>