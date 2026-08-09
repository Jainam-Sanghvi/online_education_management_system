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
    <title>tutor_profile</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/user_style.css">

</head>
<body>
<?php include 'component/user_header.php'; ?>
<!-- header section end -->

<!-- teachers profile section starts  -->

<section class="tutor-profile">

   <h1 class="heading">profile details</h1>
   <?php
   $add=$_GET["add"];
    $query="select * from tbltutor where id='$add'";
    $result=mysqli_query($con,$query);
    while($r=mysqli_fetch_array($result)){
      $name=$r["name"];
      $image=$r["image"];
      $profession=$r["profession"];
      $id=$r["id"];
    ?>
   <div class="details">
      <div class="tutor">
         <img src="images/<?php echo $image; ?>" alt="">
         <h3><?php echo $name; ?></h3>
         <span><?php echo $profession; ?></span>
      </div>
      <div class="flex">
         <p>total playlists : <span>
         <?php 
        $query1="select * from tblplaylist where tutorid='$id' and approvestatus='approve'";
        $result1=mysqli_query($con,$query1);
        $total=mysqli_num_rows($result1);
        echo $total;  
        ?> 
         </span></p>
         <p>total videos : <span>
         <?php 
        
        $query1="select * from tblcontent where tutorid='$id' and vapprovestatus='approve'";
        $result1=mysqli_query($con,$query1);
        $total=mysqli_num_rows($result1);
        echo $total;  
        ?> 
         </span></p>
         <p>total likes : <span>
         <?php 
         $query12="select * from tbllike where tutorid='$id'";
         $result12=mysqli_query($con,$query12);
         $total12=mysqli_num_rows($result12);
         echo $total12;  ?> 
         </span></p>
         <p>total comments : <span>
         <?php 
         $query1="select * from tblcomment where tutorid='$id'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?>
         </span></p>
      </div>
   </div>
<?php } ?>
</section>

<!-- teachers profile section ends -->

<!-- Course section start -->
<section class="courses">

    <h1 class="heading">latest courses</h1>
 
    <div class="box-container">
 
      <?php 
       $add=$_GET["add"];
       $query="select t.*,p.* from tbltutor t,tblplaylist p where t.id=p.tutorid and t.id='$add' and approvestatus='approve'";
       $result=mysqli_query($con,$query);
       while($r=mysqli_fetch_array($result)){
       $title=$r["title"];
       $thumb=$r["thumb"];
      ?>
       <div class="box">
          <img src="upload/<?php echo $thumb; ?>" class="thumb" alt="">
          <h3 class="title"><?php echo $title; ?></h3>
          <a href="playlist.php?add=<?php echo $r["id"];?>" class="inline-btn">view playlist</a>
       </div>
       <?php }
       ?>
       
</div>

       </section>
        <!-- courses section ends -->
<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>