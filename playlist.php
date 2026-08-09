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
    <title>playlist</title>
       <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/user_style.css">
<style>
   .playlist .row .col .save-list button{
   font-size: 1.9rem;
   border-radius: .5rem;
   background-color: var(--light-bg);
   padding: 1rem 2rem;
   cursor: pointer;
   margin-bottom: 1.6rem;
}

   .playlist .row .col .save-list button i{
      color: var(--black);
      margin-right: 1rem;
   }

   .playlist .row .col .save-list button span{
      color: var(--light-color);
   }

   .playlist .row .col .save-list button:hover{
      background-color: var(--black);
   }

   .playlist .row .col .save-list button:hover i{
      color: var(--white);
   }
      </style>
</head>
<body>
<?php include 'component/user_header.php'; ?>
<!-- header section end -->


<section class="playlist">

   <h1 class="heading">playlist details</h1>

   <div class="row">

      <?php
         $add=$_GET["add"];
        $query="select t.*,p.* from tbltutor t,tblplaylist p where t.id=p.tutorid and p.id='$add'";
        $result=mysqli_query($con,$query);
        while($r=mysqli_fetch_array($result)){
          $name=$r["name"];
          $image=$r["image"];
          $profession=$r["profession"];
          $desce=$r["desce"];
          $thumb=$r["thumb"];
          $title=$r["title"];
          $id=$r["id"];
      ?>
     
     
      <div class="col"> 
      <?php
      
      if(isset($_POST["save_list"]))
      {
         $save="insert into tblbookmark(userid,pid)values('$userid','$id')";
         mysqli_query($con,$save);
      }
     
   ?>
      <form action="" method="POST" class="save-list">
      <?php 
          if(isset($_POST["submit"])){
            $q="delete from tblbookmark where userid='$userid' and pid='$id'";
            mysqli_query($con,$q);
          }
          $likeresult1="select * from tblbookmark where userid='$userid' and pid='$id'";
          $likeresult=mysqli_query($con,$likeresult1);
          if(mysqli_num_rows($likeresult)>0){
           
          ?>
            <button type="submit" name="submit"><i class="fas fa-bookmark"></i><span>saved</span></button>
            <?php 
          }
          else
          {
         ?>
         <button type="submit" name="save_list"><i class="far fa-bookmark"></i><span>save playlist</span></button> 
         <?php }
         ?>
         </form>   
         <div class="thumb">
            <span>
            <?php 
        $query1="select * from tblcontent where pid='$id' and vapprovestatus='approve'";
        $result1=mysqli_query($con,$query1);
        $total=mysqli_num_rows($result1);
        echo $total;  
        ?> 
            </span>
            <img src="upload/<?php echo $thumb; ?>" alt="">
         </div>
      </div>

      <div class="col">
         <div class="tutor">
            <img src="images/<?php echo $image; ?>" alt="">
            <div>
               <h3><?php echo $name; ?></h3>
               <span><?php echo $profession; ?></span>
            </div>
         </div>
         <div class="details">
            <h3><?php echo $desce; ?></h3>
            <p>
               <?php echo $title; ?>
            </p>
            <div class="date"><i class="fas fa-calendar"></i><span>12-10-2025</span></div>
         </div>
      </div>

    <?php
       }
    ?>
   </div>

</section>

<!-- playlist section ends -->


<!-- videos container section starts  -->

<section class="videos-container">

   <h1 class="heading">playlist videos</h1>
   
   <div class="box-container">
   <?php
        $add=$_GET["add"];
        $query="select p.*,c.* from tblplaylist p,tblcontent c where p.id=c.pid and p.id='$add' and vapprovestatus='approve'";
        $result=mysqli_query($con,$query);
        while($r=mysqli_fetch_array($result)){
         $vtitle=$r["vtitle"];
         $vthumb=$r["vthumb"];
      ?>
        <a href="watch_video.php?add=<?php echo $r["cid"]; ?>" class="box">
         <i class="fas fa-play"></i>
         <img src="upload/<?php echo $vthumb; ?>" alt="">
         <h3><?php echo $vtitle; ?></h3>
      </a>
      <?php
} ?>
     </div>

</section>

<!-- videos container section ends -->


<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>