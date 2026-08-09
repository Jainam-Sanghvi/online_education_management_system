<?php

require("../connect.php");
//error_reporting(0);
if(isset($_GET["rm"]))
{
    $remove=$_GET["rm"];
    $query="delete from tblcontact where id='$remove'";
    if(mysqli_query($con,$query))
    {
        header("location:../superadmin/student_review.php");
    }
    else
    {
        echo "error";
    }
}
?>

