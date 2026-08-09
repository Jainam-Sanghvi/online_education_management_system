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
    <title>teachers</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/user_style.css">
<script src="jquery-3.6.0.min.js"></script>
<script src="js/search.js"></script>
</head>
<body>
<?php include 'component/user_header.php'; ?>
<!-- header section end -->

<!-- teachers section starts  -->

<section class="teachers" id="myTable">

   <h1 class="heading">expert tutors</h1>

   <form action="" method="post" class="search-tutor">
      <input type="text" name="search_tutor" id="myInput1" onkeyup="myFunction()" maxlength="100" placeholder="search tutor..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

   <div class="box-container" id="myTable1" >

      <div class="box offer" >
         <h3>become a tutor</h3>
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum, magnam!</p>
         <a href="admin/register.php" class="inline-btn">get started</a>
      </div>

    <?php
    $query="select * from tbltutor";
    $result=mysqli_query($con,$query);
    while($r=mysqli_fetch_array($result)){
      $name=$r["name"];
      $image=$r["image"];
      $profession=$r["profession"];
      $id=$r["id"];
    ?>
      <div class="box">
         <div class="tutor" >
            <img src="images/<?php echo $image; ?>" alt="">
            <div>
               <h3><?php echo $name; ?></h3>
               <span><?php echo $profession; ?></span>
            </div>
         </div>
         <p>playlists : <span>
         <?php 
        
         $query1="select * from tblplaylist where tutorid='$id' and approvestatus='approve'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  
         ?> 
         </span></p>
         <p>total videos : <span>
         <?php 
        
        $query1="select * from tblcontent where tutorid='$id' and vapprovestatus='approve'";
        $result1=mysqli_query($con,$query1);
        $total=mysqli_num_rows($result1);
        echo $total;  
        ?> 
         </span></p>
         <p>total likes : <span>
         <?php 
         $query12="select * from tbllike where tutorid='$id'";
         $result12=mysqli_query($con,$query12);
         $total12=mysqli_num_rows($result12);
         echo $total12;  ?> 
         </span></p>
         <p>total comments : <span>
         <?php 
         $query1="select * from tblcomment where tutorid='$id'";
         $result1=mysqli_query($con,$query1);
         $total=mysqli_num_rows($result1);
         echo $total;  ?>
         </span></p>
         <form action="tutor_profile.php?add=<?php echo $r["id"]; ?>" method="post">
            <!-- <input type="hidden" name="tutor_email" value=""> -->
            <input type="submit" value="view profile" name="tutor_fetch" class="inline-btn">
         </form>
      </div>
<?php
    }
?>
      
     

   
   </div>
</section>

<!-- teachers section ends -->


<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>