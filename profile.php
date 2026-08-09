<?php
require("connect.php");
error_reporting(0);

$email=$_COOKIE["email"];
$query="select * from tbluser where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$userid=$r["userid"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/user_style.css">

</head>
<body>
<?php include 'component/user_header.php'; ?>
<!-- header section end -->

<section class="profile">

   <h1 class="heading">profile details</h1>

   <div class="details">
   <?php
       $query="select * from tbluser where email='$email'";
       $result=mysqli_query($con,$query);
       while($r=mysqli_fetch_array($result)){
         $name=$r["name"];
         $image=$r["image"];
      ?>
      <div class="user">
         <img src="images/<?php echo $image; ?>" alt="">
         <h3><?php echo $name; ?></h3>
         <p>student</p>
         <a href="update.php?update=<?php echo $r["userid"]; ?>" class="inline-btn">update profile</a>
      </div>
<?php }?>
      <div class="box-container">


         <div class="box">
            <div class="flex">
               <i class="fas fa-heart"></i>
               <div>
                  <h3>

                  <?php 
                  $query1="select * from tbllike where userid='$userid'";
                  $result1=mysqli_query($con,$query1);
                  $total=mysqli_num_rows($result1);
                  echo $total;  ?> 
                  </h3>
                  <span>liked tutorials</span>
               </div>
            </div>
            <a href="likes.php" class="inline-btn">view liked</a>
         </div>

         <div class="box">
            <div class="flex">
               <i class="fas fa-comment"></i>
               <div>
                  <h3>
                  <?php 
                  $query1="select * from tblcomment where userid='$userid'";
                  $result1=mysqli_query($con,$query1);
                  $total=mysqli_num_rows($result1);
                  echo $total;  ?>
                  </h3>
                  <span>video comments</span>
               </div>
            </div>
            <a href="comments.php" class="inline-btn">view comments</a>
         </div>

      </div>

   </div>

</section>

<!-- profile section ends -->




<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>