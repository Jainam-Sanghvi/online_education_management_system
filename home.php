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

    <title>home</title>
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
 
<section class="quick-select">

   <h1 class="heading">quick options</h1>
   <div class="box-container">

      
      <div class="box">
         <h3 class="title">likes and comments</h3>
         <p>total likes : <span>
         <?php 
         $query1="select * from tbllike where userid='$userid'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?> 
         </span></p>
         <a href="likes.php" class="inline-btn">view likes</a>
         <p>total comments : <span>
         <?php 
         $query1="select * from tblcomment where userid='$userid'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?>
         </span></p>
         <a href="comments.php" class="inline-btn">view comments</a>
         <p>saved playlist : <span>
         <?php 
         $query1="select * from tblbookmark where userid='$userid'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?>
         </span></p>
         <a href="bookmark.php" class="inline-btn">view playlists</a>
         
      </div>

      <div class="box">
         <h3 class="title">top categories</h3>
         <div class="flex">
            <a href=""><i class="fas fa-code"></i><span>development</span></a>
            <a href="#"><i class="fas fa-chart-simple"></i><span>business</span></a>
            <a href="#"><i class="fas fa-pen"></i><span>design</span></a>
            <a href="#"><i class="fas fa-chart-line"></i><span>marketing</span></a>
            <a href="#"><i class="fas fa-music"></i><span>music</span></a>
            <a href="#"><i class="fas fa-camera"></i><span>photography</span></a>
            <a href="#"><i class="fas fa-cog"></i><span>software</span></a>
            <a href="#"><i class="fas fa-vial"></i><span>science</span></a>
         </div>
      </div>
      <div class="box">
         <h3 class="title">popular topics</h3>
         <div class="flex">
            <a href="#"><i class="fab fa-html5"></i><span>HTML</span></a>
            <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
            <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
            <a href="#"><i class="fab fa-react"></i><span>react</span></a>
            <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
            <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
         </div>
      </div>

      <div class="box tutor">
         <h3 class="title">become a tutor</h3>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, laudantium.</p>
         <a href="admin/register.php" class="inline-btn">get started</a>
      </div>
 <!--  <div class="box" style="text-align: center;">
         <h3 class="title">please login or register</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div> -->
   </div>  
</section>

<!-- Course section start -->
<section class="courses">

   <h1 class="heading">latest courses</h1>
   
   <div class="box-container" id="myTable">

      <?php
       $query="select t.*,p.* from tbltutor t,tblplaylist p where t.id=p.tutorid and approvestatus='approve' order by p.id desc limit 3";
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
      
   
   <div class="more-btn">
      <a href="course.php" class="inline-option-btn">view more</a>
   </div>

</section>

<!-- courses section ends -->



<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>