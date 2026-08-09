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
    <title>watch_video</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/user_style.css">

<style>
   .empty{
      color :red;
      font-size:2rem;
     
   }
   </style>

</head>
<body>
<?php include 'component/user_header.php'; ?>
<!-- header section end -->


<!-- watch video section starts  -->

<section class="watch-video">

  
   <div class="video-details">

   <?php
         $add=$_GET["add"];
        $query="select t.*,p.*,c.* from tbltutor t,tblplaylist p,tblcontent c where t.id=p.tutorid and p.id=c.pid and c.cid='$add'";
        $result=mysqli_query($con,$query);
        while($r=mysqli_fetch_array($result)){
         $vtitle=$r["vtitle"];
         $vthumb=$r["vthumb"];
         $video=$r["video"];
         $image=$r["image"];
         $name=$r["name"];
         $profession=$r["profession"];
         $vdesce=$r["vdesce"];
         $tutorid=$r["tutorid"];
         $cid=$r["cid"];
         
      ?>
      <video src="upload/<?php echo $video; ?>" class="video" poster="upload/<?php echo $vthumb ?>" controls autoplay></video>
      <h3 class="title"><?php echo $vtitle ?></h3>
      <div class="info">
         <p><i class="fas fa-calendar"></i><span>12-10-2025</span></p>
         <p><i class="fas fa-heart"></i><span>
         <?php 
         $query1="select * from tbllike where cid='$cid'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?> 
         </span></p>
        <p><a href="upload/<?php echo $video; ?>" download><i class="fas fa-download"></i></a></p>
      </div>
      <div class="tutor">
         <img src="images/<?php echo $image; ?>" alt="">
         <div>
            <h3><?php echo $name; ?></h3>
            <span><?php echo $profession; ?></span>
         </div>
      </div>
      <?php
      
         if(isset($_POST["submit"]))
         {
            $likeq="insert into tbllike(userid,tutorid,cid)values('$userid','$tutorid','$cid')";
            mysqli_query($con,$likeq);
         }
        
      ?>
      <form action="" method="POST" class="flex">
         <a href="playlist.php?add=<?php echo $r["pid"];  ?>" class="inline-btn">view playlist</a>
          <?php 
          if(isset($_POST["submit1"])){
            $q="delete from tbllike where userid='$userid' and cid='$cid'";
            mysqli_query($con,$q);
          }
          $likeresult1="select * from tbllike where userid='$userid' and cid='$cid'";
          $likeresult=mysqli_query($con,$likeresult1);
          if(mysqli_num_rows($likeresult)>0){
           
          ?>
          <button type="submit" name="submit1"><i class="fas fa-heart"></i><span>liked</span></button> 
         <?php 
          }
          else
          {
         ?>
         <button type="submit" name="submit"><i class="far fa-heart"></i><span>like</span></button> 
         <?php }
         ?>
      </form>
      <div class="description"><p><?php echo $vdesce; ?></p></div>
      <?php } ?>
   </div>
   

</section>

<!-- watch video section ends -->

<?php
if(isset($_POST["add_comment"]))
{
   $comment=$_POST["comment"];
   $date = date("d-m-Y");
   $query="insert into tblcomment(contentid,userid,tutorid,comment,date)values('$cid','$userid','$tutorid','$comment','$date')";
   mysqli_query($con,$query);
}
?>
<!-- comments section starts  -->

<section class="comments">

    <h1 class="heading">add a comment</h1>
 
    <form action="" method="POST" class="add-comment">
       <!-- <input type="hidden" name="content_id" value=""> -->
       <textarea name="comment" required placeholder="write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
       <input type="submit" value="add comment" name="add_comment" class="inline-btn">
    </form>
 
    <h1 class="heading">user comments</h1>
 
   
    <div class="show-comments">
    <?php
     $add=$_GET["add"];
    $query="select u.*,c.* from tbluser u,tblcomment c where u.userid=c.userid and contentid='$add'";
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
        
             <img src="images/<?php echo $image; ?>" alt="">
             <div>
                <h3><?php echo $name; ?></h3>
                <span><?php echo $date; ?></span>
             </div>
          </div>
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
 
 
 

<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>
