<?php

require("../connect.php");

error_reporting(0);
session_start();
$email= $_SESSION['email'];

$query="select * from tbltutor where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$name=$r["name"];
$id=$r["id"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">
   <script src="../jquery-3.6.0.min.js"></script>
    <script src="../js/search.js"></script>

</head>
<body>

<?php include '../component/admin_header.php'; ?>
   
<section class="dashboard" id="myTable">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>welcome!</h3>
         <p><?php echo $name; ?></p>
         
         <a href="profile.php" class="btn">view profile</a>
      </div>

      <div class="box">
         <h3><?php 
         $query1="select * from tblcontent where tutorid='$id'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?> </h3>
         <p>total contents</p>
         <a href="add_content.php" class="btn">add new content</a>
      </div>

      <div class="box">
         <h3><?php 
         $query1="select * from tblplaylist where tutorid='$id'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?> </h3>
         <p>total playlists</p>
         <a href="add_playlist.php" class="btn">add new playlist</a>
      </div>

      <div class="box">
         <h3>
         <?php 
         $query1="select * from tbllike where tutorid='$id'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?>
         </h3>
         <p>total likes</p>
         <a href="likes.php" class="btn">view likes</a>
      </div>

      <div class="box">
         <h3>
         <?php 
         $query1="select * from tblcomment where tutorid='$id'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?>
         </h3>
         <p>total comments</p>
         <a href="comments.php" class="btn">view comments</a>
      </div>

      

   </div>

</section>
<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>