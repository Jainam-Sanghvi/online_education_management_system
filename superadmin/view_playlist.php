<?php
require('../connect.php');

error_reporting(0);



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>view_playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">

</head>
<body>

<?php include '../component/superadmin_header.php'; ?>
   
<section class="playlist-details">

   <h1 class="heading">playlist details</h1>
   <div class="row">
   <?php
      $up=$_GET['view'];
      $query="select * from tblplaylist where id='$up'";
      $result=mysqli_query($con,$query);
      while($r=mysqli_fetch_array($result)){
      $id=$r["id"];
      $title=$r["title"];
      $desce=$r["desce"];
      $thumb=$r["thumb"];
      $status=$r["status"];

      ?>
      <div class="thumb">
         <span>
         <?php 
          $query1="select * from tblcontent where pid='$up'";
          $result1=mysqli_query($con,$query1);
          $total=mysqli_num_rows($result1);
          echo $total;  
        ?> 
         </span>
         <img src="../upload/<?php echo $thumb; ?>" alt="">
      </div>
      <div class="details">
         <h3 class="title"><?php echo $title; ?></h3>
         <div class="date"><i class="fas fa-calendar"></i><span>12-10-2025</span></div>
         <div class="description"><?php echo $desce; ?></div>
        
      </div>
      <?php } 
      ?>
   </div>
</section>

<section class="contents">

   <h1 class="heading">playlist videos</h1>

   <div class="box-container">

      <?php
      $up=$_GET['view'];
      $query="select * from tblcontent where pid='$up'";
      $result=mysqli_query($con,$query);
      while($r=mysqli_fetch_array($result)){
      $video=$r["video"];
      $vthumb=$r["vthumb"];
      $vtitle=$r["vtitle"];
      $vdesce=$r["vdesce"];
      $id=$r["cid"];

      ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-dot-circle" style="<?php if($status == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($status == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?php echo $status; ?></span></div>
            <div><i class="fas fa-calendar"></i><span>12-10-2025</span></div>
         </div>
         <img src="../upload/<?php echo $vthumb; ?>" class="thumb" alt="">
         <h3 class="title"><?php echo $vtitle;?></h3>
        
        <a href="view_content.php?view=<?php echo $id;?>" class="btn">view content</a>
      
        </div>
  <?php }
  ?>
   </div>

</section>
<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>