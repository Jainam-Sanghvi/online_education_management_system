<?php
require("../connect.php");
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>review</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

        <!-- custom css file link  -->
        <link rel="stylesheet" href="../css/user_style.css">
        <script src="../jquery-3.6.0.min.js"></script>
        <script src="../js/search.js"></script>
</head>
<body>
<?php include '../component/superadmin_header.php'; ?>
<!-- header section end -->

<!-- teachers section starts  -->

<section class="teachers" id="myTable">

   <h1 class="heading">student's review</h1>

   <form action="" method="post" class="search-tutor">
      <input type="text" name="search_tutor" id="myInput1" onkeyup="myFunction()" maxlength="100" placeholder="search tutor..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

   <div class="box-container" id="myTable1" >
    <?php
    $query="select u.*,c.* from tbluser u,tblcontact c where u.userid=c.userid";
    $result=mysqli_query($con,$query);
    while($r=mysqli_fetch_array($result)){
      $name=$r["name"];
     $image=$r["image"];
     $msg=$r["msg"];
     $number=$r["number"];
     $email=$r["email"];
    ?>
      <div class="box">
         <div class="tutor" >
            <img src="../images/<?php echo $image; ?>" alt="">
            <div>
               <h3><?php echo $name; ?></h3>
               <span>student</span>
            </div>
         </div>
         <p>message : <?php echo $msg; ?></p>
         <p>email : <?php echo $email; ?></p>
         <p>contact no : <?php echo $number; ?></p>
         
         <a href="removereview.php?rm=<?php echo $r["id"]; ?>" class="delete-btn">Remove</a>
           
      </div>
<?php
    }
?>
      
     

   
   </div>
</section>





<!-- footer section start -->
<?php include '../component/footer.php'; ?>
<!-- footer section ends -->
<script src="../js/admin_script.js"></script>
<script src="../js/script.js"></script>
</body>
</html>