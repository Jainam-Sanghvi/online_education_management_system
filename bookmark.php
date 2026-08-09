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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>bookmarks</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_style.css">
   <script src="jquery-3.6.0.min.js"></script>
    <script src="js/search.js"></script>
    <style>
         .empty{
                  background-color: var(--white);
                  border-radius: .5rem;
                  padding: 1.5rem;
                  text-align: center;
                  width: 100%;
                  font-size: 2.2rem;
                  color: var(--red);
               }    
        </style>
</head>
<body>

<?php include 'component/user_header.php'; ?>

<section class="courses" id="myTable">

   <h1 class="heading">bookmarked playlists</h1>

   <div class="box-container">

      <?php
          $query="select b.*,p.*,t.* from tblbookmark b,tblplaylist p,tbltutor t where b.pid=p.id and p.tutorid=t.id and userid='$userid'";
          $result=mysqli_query($con,$query);
          if(mysqli_num_rows($result) > 0){
          while($r=mysqli_fetch_array($result)){
            $name=$r["name"];
            $image=$r["image"];
           $thumb=$r["thumb"];
           $title=$r["title"];
         ?>
      <div class="box">
         <div class="tutor">
            <img src="images/<?php echo $image; ?>" alt="">
            <div>
               <h3><?php echo $name; ?></h3>
               <span>12-10-2025</span>
            </div>
         </div>
         <img src="upload/<?php echo $thumb; ?>" class="thumb" alt="">
         <h3 class="title"><?php echo $title; ?></h3>
         <a href="playlist.php?add=<?php echo $r["pid"]; ?>" class="inline-btn">view playlist</a>
      </div>
      <?php
            }
        }
        else
        {
           echo '<p class="empty">nothing bookmarked yet !</p>';
        }
      ?>

   </div>

</section>










<?php include 'component/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>