<?php

require("../connect.php");
//error_reporting(0);
if(isset($_GET["rm"]))
{
    $remove=$_GET["rm"];
    mysqli_query($con,"delete from tblcomment where contentid='$remove'");
    $q="delete from tbllike where cid='$remove'";
    mysqli_query($con,$q);
    $query="delete from tblcontent where cid='$remove'";
    if(mysqli_query($con,$query))
    {
        header("location:../superadmin/approve.php");
    }
    else
    {
        echo "error";
    }
}
?>

