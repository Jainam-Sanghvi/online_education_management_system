<?php
require("../connect.php");
error_reporting(0);
$email=$_COOKIE["email"];
$query="select * from tbladmin where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);

$adminid=$r["id"];
?>
<?php
$id=$_GET["id"];
 $query="select * from tblplaylist where id='$id'";
 $result=mysqli_query($con,$query);
 $r=mysqli_fetch_array($result);
$thumb=$r["thumb"];
$title=$r["title"];
$desce=$r["desce"];

?>

<?php
if(isset($_POST["submit"]))
{
   $approvestatus=$_POST["approvestatus"];
   $query="update tblplaylist set approvestatus='$approvestatus' where id='$id'";
   mysqli_query($con,$query);
   if(isset($_POST["submit"]))
   {
      header("location:approveplaylist.php");
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>form</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">
</head>
<body>

<?php include '../component/superadmin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">check playlist details</h1>

   <form action="" method="POST" enctype="multipart/form-data">
   <p>playlist status <span>*</span></p>
      <select name="approvestatus" class="box" required>
      <option value="" selected disabled>-- select status</option>
         <option value="approve">approve</option>
         <option value="pending">pending</option>
         <option value="dismiss">notapprove</option>
         
      </select>
     <p>playlist title <span>*</span></p>
      <input type="text" name="title" value="<?php echo $title; ?>" maxlength="100" required disabled class="box">
     
     <input type="submit" value="approve playlist" name="submit" class="btn">
   </form>

</section>

<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>

