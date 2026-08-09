<?php

require("connect.php");
error_reporting(0);


if(isset($_GET["rm"]))
{
    $remove=$_GET["rm"];
    $query1="select * from tblcomment where commentid='$remove'";
    $result=mysqli_query($con,$query1);
    $r=mysqli_fetch_array($result);
    $cid=$r["contentid"];
   
    $query="delete from tblcomment where commentid='$remove'";
   
    if(mysqli_query($con,$query))
    {
        header("Location: watch_video.php?add=$cid");
        exit;
    }
    else
    {
        echo "error";
    }
}
?>

