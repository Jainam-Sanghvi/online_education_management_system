<?php
require('../connect.php');

error_reporting(0);

$up=$_GET['view'];
$query="select * from tblcontent where cid='$up'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$video=$r["video"];
$vthumb=$r["vthumb"];
$vtitle=$r["vtitle"];
$vdesce=$r["vdesce"];
$id=$r["cid"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view_content</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/adminmain.css">
</head>
<body>
<?php include '../component/superadmin_header.php'; ?>
<section class="view-content">
   <div class="container">
      <video src="../upload/<?php echo $video; ?>" autoplay controls poster="../upload/<?php echo $vthumb; ?>" class="video"></video>
      <div class="date"><i class="fas fa-calendar"></i><span>12-10-2025</span></div>
      <h3 class="title"><?php echo $vtitle; ?></h3>
      <div class="flex">
       
       </div>
      <div class="description"><?php echo $vdesce; ?></div>
      <form action="" method="post">
         <div class="flex-btn">
        
           </div>
      </form>
   </div>
 

</section>
<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>
</body>
</html>