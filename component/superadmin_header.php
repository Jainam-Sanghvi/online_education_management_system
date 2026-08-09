<?php

require('../connect.php');


if(!isset($_COOKIE['email'])){
  header('location:login.php');
}
$email= $_COOKIE['email'];
$query="select * from tbladmin where email='$email'";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="js/search.js"></script>

</head>
<body>

<header class="header">

   <section class="flex">

      <a href="admin.php" class="logo">Admin.</a>

      <form action="search_page.php" method="post" class="search-form">
         <input type="text" name="search" placeholder="search here..." id="myInput"  onkeyup="myFunction()" required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
      <?php 
   $result=mysqli_query($con,$query);
   while($r=mysqli_fetch_array($result)){
      $name=$r["name"];
      $image=$r["image"];
      $profession=$r["profession"];
   
   ?>
      <div class="profile">
         <img src="../images/<?php echo $image; ?>" alt="">
         <h3><?php echo $name;?></h3>
         <span><?php echo $profession; ?></span>
         
        
         <a href="admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
        
      </div>

   </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
        
   <img src="../images/<?php echo $image; ?>" alt="">
         <h3><?php echo $name;?></h3>
         <span><?php echo $profession; ?></span>
        
      </div>
      <?php
   }
?>
   <nav class="navbar">
      <a href="admin.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="approveplaylist.php"><i class="fa-solid fa-bars-staggered"></i><span>approve playlist</span></a>
      <a href="approve.php"><i class="fas fa-graduation-cap"></i><span>approve video</span></a>
      <a href="student_review.php"><i class="fas fa-comment"></i><span>student response</span></a>
      <a href="admin_logout.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>

</div>

<!-- side bar section ends -->
</body>
</html>