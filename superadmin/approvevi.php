<?php
require("../connect.php");
error_reporting(0);
$email=$_COOKIE["email"];
?>

<?php
$id=$_GET["id"];
$query="select * from tblcontent where cid='$id'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$vtitle=$r["vtitle"];



?>

<?php
if(isset($_POST["submit"]))
{
   $vapprovestatus=$_POST["vapprovestatus"];
   $query="update tblcontent set vapprovestatus='$vapprovestatus' where cid='$id'";
   mysqli_query($con,$query);
   if(isset($_POST["submit"]))
   {
      header("location:approve.php");
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

   <h1 class="heading">check video details</h1>

   <form action="" method="POST">
   <p>video status <span>*</span></p>
      <select name="vapprovestatus" class="box" required>
      <option value="" selected disabled>-- select status</option>
         <option value="approve">approve</option>
         <option value="pending">pending</option>
         <option value="dismiss">notapprove</option>
         
      </select>
     <p>video title <span>*</span></p>
      <input type="text" name="title" value="<?php echo $vtitle; ?>" maxlength="100" required disabled class="box">
     
     <input type="submit" value="approve video" name="submit" class="btn">
   </form>

</section>

<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
