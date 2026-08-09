<?php
require("../connect.php");

error_reporting(0);
session_start();
$email= $_SESSION['email'];

$query="select * from tbltutor where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$tutorid=$r["id"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contents</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">
   <link rel="stylesheet" href="../css/user_style.css">
   <script src="../jquery-3.6.0.min.js"></script>
    <script src="../js/search.js"></script>

    <style>
   .empty{
      color :red;
      font-size:2.3rem;
     
   }
   </style>

</head>
<body>

<?php include '../component/admin_header.php'; ?>
   
<section class="comments" id="myTable">

   <h1 class="heading">user comments</h1>

   
   <div class="show-comments">
      <?php
         $query="select cm.*,c.* from tblcomment cm,tblcontent c where cm.contentid=c.cid and cm.tutorid='$tutorid'";
         $result=mysqli_query($con,$query);
         if(mysqli_num_rows($result) > 0 ){
         while($r=mysqli_fetch_array($result))
         {
            
      ?>
      <div class="box" >
      <div class="content"><span><?php echo $r["date"]; ?></span><p> - <?php echo $r["vtitle"]; ?> - </p><a href="view_content.php?view=<?php echo $r["cid"]; ?>">view content</a></div>
         <p class="text"><?php echo $r["comment"]; ?></p>
         <form action="" method="POST">
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

<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>


