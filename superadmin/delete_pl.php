<?php

require("../connect.php");
//error_reporting(0);
if(isset($_GET["rm"]))
{
    $remove=$_GET["rm"];
    mysqli_query($con, "DELETE FROM tblbookmark WHERE pid = $remove");
    mysqli_query($con, "DELETE tbllike FROM tbllike 
                     JOIN tblcontent ON tbllike.cid = tblcontent.cid 
                     WHERE tblcontent.pid = $remove");

mysqli_query($con, "DELETE tblcomment FROM tblcomment 
INNER JOIN tblcontent ON tblcomment.contentid = tblcontent.cid 
WHERE tblcontent.pid = '$remove'");
    $q2="delete from tblcontent where pid='$remove'";
    mysqli_query($con,$q2);
   
    $query="delete from tblplaylist where id='$remove'";
    if(mysqli_query($con,$query))
    {
        header("location:../superadmin/approveplaylist.php");
    }
    else
    {
        echo "error";
    }
}
?>

