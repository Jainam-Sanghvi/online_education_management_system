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
    <title>course</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/user_style.css">
<script src="jquery-3.6.0.min.js"></script>
<script src="js/search.js"></script>

</head>
<body>
<?php include 'component/user_header.php'; ?>
<!-- header section end -->
<section class="courses">

   <h1 class="heading">latest courses</h1>

   <div class="box-container" id="myTable">

      <?php
       $query="select t.*,p.* from tbltutor t,tblplaylist p where t.id=p.tutorid and approvestatus='approve' order by p.id desc";
       $result=mysqli_query($con,$query);
       while($r=mysqli_fetch_array($result)){
         $name=$r["name"];
         $image=$r["image"];
         $profession=$r["profession"];
         $thumb=$r["thumb"];
         $title=$r["title"];
      ?>
      <div class="box">
      
         <div class="tutor">
           
            <img src="images/<?php echo $image; ?>" alt="">
            <div>
               <h3><?php echo $name; ?></h3>
               <span>12-10-2025</span>
              
            </div>
           
         </div>
       
         
         <img src="upload/<?php echo $thumb;?>" class="thumb" alt="">
         <h3 class="title"><?php echo $title;?></h3>

        
         <a href="playlist.php?add=<?php echo $r["id"]; ?>" class="inline-btn">view playlist</a>
        
      </div>
    <?php } ?>
      </div>
      
   
  

</section>

<!-- courses section ends -->



<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>