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
<link rel="stylesheet" href="../css/user_style.css">
<style>
   .empty{
      color :red;
      font-size:2.3rem;
     
   }
   </style>
</head>
<body>
<?php include '../component/admin_header.php'; ?>
<section class="view-content">
   <div class="container">
      <video src="../upload/<?php echo $video; ?>" autoplay controls poster="../upload/<?php echo $vthumb; ?>" class="video"></video>
      <div class="date"><i class="fas fa-calendar"></i><span>12-10-2025</span></div>
      <h3 class="title"><?php echo $vtitle; ?></h3>
      <div class="flex">
         <div><i class="fas fa-heart"></i><span>
            <?php
              $query1="select * from tbllike where cid='$id'";
              $result1=mysqli_query($con,$query1);
              $total=mysqli_num_rows($result1);
              echo $total;
            ?>
         </span></div>
       </div>
      <div class="description"><?php echo $vdesce; ?></div>
      <form action="" method="post">
         <div class="flex-btn">
         <a href="update_video.php?update=<?php echo $id; ?>" class="option-btn">update</a>
         <a href="delete_content.php?rm=<?php echo $id; ?>" class="delete-btn" onclick="return confirm('delete this video?');" >delete</a>
            
           </div>
      </form>
   </div>
 

</section>

<section class="comments">

   <h1 class="heading">user comments</h1>

   
   <div class="show-comments">
      <?php
         $query="select u.*,c.* from tbluser u,tblcomment c where u.userid=c.userid and contentid='$up'";
         $result=mysqli_query($con,$query);
         if(mysqli_num_rows($result) > 0){
            while($r=mysqli_fetch_array($result)){
              $name=$r["name"];
              $image=$r["image"];
              $date=$r["date"];
              $comment=$r["comment"];
      ?>
      <div class="box">
         <div class="user">
            <img src="../images/<?php echo $image; ?>" alt="">
            <div>
               <h3><?php echo $name; ?></h3>
               <span><?php echo $date; ?></span>
            </div>
         </div>
         <p class="text"><?php echo $comment; ?></p>
         <form action="" method="POST" class="flex-btn">
         <a href="delete_comment.php?rm=<?php echo $r["commentid"];?>"  class="inline-delete-btn" onclick="return confirm('delete this comment?');" >delete comment</a>
          
      </form>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">no comments added yet!</p>';
      }
      ?>
      </div>
   
</section>
 
 <!-- comments section ends -->
<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>
</body>
</html>