<?php
require("../connect.php");
error_reporting(0);
$email=$_SESSION["email"];

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
   <script src="../jquery-3.6.0.min.js"></script>
    <script src="../js/search.js"></script>

</head>
<body>

<?php include '../component/admin_header.php'; ?>
   
<section class="contents" id="myTable">

   <h1 class="heading">your contents</h1>

   <div class="box-container">

   <div class="box" style="text-align: center;">
      <h3 class="title" style="margin-bottom: .5rem;">create new content</h3>
      <a href="add_content.php" class="btn">add content</a>
   </div>

   <?php
       $query="select t.*,p.*,c.* from tbltutor t,tblplaylist p,tblcontent c where t.id=p.tutorid and p.id=c.pid and t.email='$email'";
       $result=mysqli_query($con,$query);
       while($r=mysqli_fetch_array($result)){
         $vthumb=$r["vthumb"];
         $vdesce=$r["vdesce"];
         $status=$r["status"];
         $vtitle=$r["vtitle"];
         $id=$r["cid"];
      ?>
   
      <div class="box">
         <div class="flex">
         <div><i class="fas fa-circle-dot" style="<?php if($status == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($status == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?php echo $status; ?></span></div>
             
         <div><i class="fas fa-calendar"></i><span>12-10-2025</span></div>
         </div>
         <img src="../upload/<?php echo $vthumb; ?>" class="thumb" alt="">
         <h3 class="title"><?php echo $vtitle;?></h3>


        
         <form action="" method="POST" class="flex-btn">
           
            <a href="update_video.php?update=<?php echo $r["cid"] ?>" class="option-btn">update</a>
            <a href="delete_content.php?rm=<?php echo $r["cid"] ?>" class="delete-btn" onclick="return confirm('delete this video?');" >delete</a>
            
         </form>
         <a href="view_content.php?view=<?php echo $r["cid"];?>" class="btn">view content</a>
      </div>
      <?php
      }
      ?>

   </div>

</section>

<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>