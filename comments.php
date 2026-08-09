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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user comments</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_style.css">
   <script src="jquery-3.6.0.min.js"></script>
    <script src="js/search.js"></script>
   <style>
   .empty{
      color :red;
      font-size:2rem;
     
   }
   </style>
</head>
<body>

<?php include 'component/user_header.php'; ?>

<section class="comments" id="myTable">

   <h1 class="heading">your comments</h1>

   
   <div class="show-comments">
   <?php
     
    $query="select u.*,c.*,con.* from tbluser u,tblcomment c,tblcontent con where u.userid=c.userid and c.contentid=con.cid and u.userid='$userid'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
    while($r=mysqli_fetch_array($result)){
      $name=$r["name"];
      $image=$r["image"];
      $title=$r["vtitle"];
      $date=$r["date"];
      $comment=$r["comment"];
    ?>
       <div class="box">
       <div class="content"><span><?php echo $date; ?></span><p> - <?php echo $title; ?> - </p><a href="watch_video.php?add=<?php echo $r["cid"]; ?>">view content</a></div>
          <p class="text"><?php echo $comment; ?></p>
         <?php 
         if($r['userid'] == $userid){ 
         ?>
          <form action="" method="POST" class="flex-btn">
          <a href="update_comment.php?update=<?php echo $r["commentid"]; ?>" class="inline-option-btn">update comment</a>
         <a href="delete_comment.php?rm=<?php echo $r["commentid"];?>"  class="inline-delete-btn" onclick="return confirm('delete this comment?');" >delete comment</a>
            </form>
            <?php
         }
            ?> 
             </div>
          <?php 
         }
         
         }
         else
         {
            echo '<p class="empty">no comments added yet !</p>';
         }
        
          ?>
      
       
      </div>
   
</section>

<!-- comments section ends -->

<?php include 'component/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>