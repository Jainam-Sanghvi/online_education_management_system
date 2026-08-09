<?php
require('../connect.php');
session_start();

if(!isset($_SESSION['email'])){
  header('location:../admin/login.php');
}
$email= $_SESSION['email'];


$query="select * from tbltutor where email='$email'";


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

      <a href="dashboard.php" class="logo">Admin.</a>

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
         <img src="../images/<?php echo $r["image"]; ?>" alt="">
         <h3><?php echo $r["name"]; ?></h3>
         <span><?php echo $r["profession"]; ?></span>
         <a href="profile.php" class="btn">view profile</a>
         <!-- <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div> -->
         <a href="../component/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <!-- <h3>please login or register</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div> -->
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
        
         <img src="../images/<?php echo $r["image"]; ?>" alt="">
         <h3><?php echo $r["name"]; ?></h3>
         <span><?php echo $r["profession"]; ?></span>
         <a href="profile.php" class="btn">view profile</a>
         
         <!-- <h3>please login or register</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div> -->
         
      </div>
<?php
   }
?>
   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="playlists.php"><i class="fa-solid fa-bars-staggered"></i><span>playlists</span></a>
      <a href="contents.php"><i class="fas fa-graduation-cap"></i><span>contents</span></a>
      <a href="comments.php"><i class="fas fa-comment"></i><span>comments</span></a>
      <a href="../component/admin_logout.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>

</div>

<!-- side bar section ends -->
</body>
</html>