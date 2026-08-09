<?php

require("../connect.php");

error_reporting(0);
$email=$_COOKIE["email"];
$query="select * from tbladmin where email='$email'";
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
   <title>admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">
   <script src="../jquery-3.6.0.min.js"></script>
   <script src="../js/search.js"></script>
</head>
<body>

<?php include '../component/superadmin_header.php'; ?>
   
<section class="dashboard" id="myTable">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>welcome!</h3>
         <p><?php echo $name; ?></p>
         
        
      </div>
      <div class="box">
         <h3>
         <?php 
         $query1="select * from tblplaylist";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?> 
         </h3>
         <p>approve playlist</p>
         <a href="approveplaylist.php" class="btn">approve playlist</a>
      </div>
      <div class="box">
         <h3>
         <?php 
         $query1="select * from tblcontent";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?> 
         </h3>
         <p>approve video</p>
         <a href="approve.php" class="btn">approve video</a>
      </div>
      <div class="box">
         <h3>
         <?php 
         $query1="select * from tblcontact";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?> 
         </h3>
         <p>student review</p>
         <a href="student_review.php" class="btn">Student Review</a>
      </div>
      
      </div>

      
      </div>

      

   </div>

</section>
<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>
<script src="../js/script.js"></script>
</body>
</html>