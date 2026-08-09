<?php

require("../connect.php");
error_reporting(0);


if(isset($_GET["rm"]))
{
    $remove=$_GET["rm"];
   
   
    $query="delete from tblcomment where commentid='$remove'";
   
    if(mysqli_query($con,$query))
    {
        header("Location: comments.php");
        exit;
    }
    else
    {
        echo "error";
    }
}
?>

