<?php
include '../connect.php';

setcookie("email","",time()-60);
header('location:login.php');
?>