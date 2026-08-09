<?php
require('connect.php');
//session_start();

if(!isset($_COOKIE['email'])){
  header('location:login.php');
}
$email= $_COOKIE['email'];
$query="select * from tbluser where email='$email'";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user header</title>
   <script src="jquery-3.6.0.min.js"></script>
   <script src="js/search.js"></script>
</head>
<body>
<header class="header">

<section class="flex">

   <a href="home.php" class="logo">Educa.</a>

   <form action="" method="POST" class="search-form">
         <input type="text" name="search_course" id="myInput"  onkeyup="myFunction()" placeholder="search courses..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_course_btn"></button>
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
     
   ?>
      <div class="profile">
        <img src="images/<?php echo $image;?>" alt="">
        <h3><?php echo $name; ?></h3>
         <span>student</span>
         <a href="profile.php" class="btn">view profile</a>
         <div class="flex-btn">
         <a href="user_logout.php" class="option-btn">logout</a>
            
         </div>
</div>
</section>
</header>

<!-- side bar section starts  -->

<div class="side-bar">
<div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>
    <div class="profile">
        <img src="images/<?php echo $image;?>" alt="">
        <h3><?php echo $name; ?></h3>
         <span>student</span>
         <a href="profile.php" class="btn">view profile</a>
         </div>
         <?php
   }
         ?>
<nav class="navbar">
    <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
    <a href="about.php"><i class="fas fa-question"></i><span>about us</span></a>
    <a href="course.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
    <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
    <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
 </nav>
</div>
</body>
</html>