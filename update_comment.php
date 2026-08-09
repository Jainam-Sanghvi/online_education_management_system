<?php
require("connect.php");
error_reporting(0);

$email=$_COOKIE["email"];

$update=$_GET["update"];
$query="select * from tblcomment where commentid='$update'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$comment=$r["comment"];
$cid=$r["contentid"];
if(isset($_POST["update"]))
{
  
   $comment1=$_POST["comment"];
   $query="update tblcomment set comment='$comment1' where commentid='$update'";
   $result=mysqli_query($con,$query);
   if($result)
   {
      header("Location: watch_video.php?add=$cid");
      exit;
   }
}


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

<section class="edit-comment">
   <h1 class="heading">edit comment</h1>
   <form action="" method="POST">
     
      <textarea name="comment" class="box" maxlength="1000" required  cols="30" rows="10"><?php echo $comment; ?></textarea>
      <div class="flex">
         <a href="watch_video.php?add=<?php echo $cid;?>" class="inline-option-btn">cancel edit</a>
       <input type="submit" value="update now" name="update" class="inline-btn">
      </div>
   </form>
</section>
 
 

<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>
