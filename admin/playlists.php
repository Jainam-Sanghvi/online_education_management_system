<?php
require("../connect.php");
error_reporting(0);
$email=$_SESSION["email"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Playlists</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">
   <script src="../jquery-3.6.0.min.js"></script>
   <script src="../js/search.js"></script>

</head>
<body>

<?php include '../component/admin_header.php'; ?>

<section class="playlists" id="myTable">

   <h1 class="heading">added playlists</h1>

   <div class="box-container">
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">create new playlist</h3>
         <a href="add_playlist.php" class="btn">add playlist</a>
      </div>

      <?php
       $query="select t.*,p.* from tbltutor t,tblplaylist p where t.id=p.tutorid and t.email='$email'";
       $result=mysqli_query($con,$query);
       while($r=mysqli_fetch_array($result)){
         $thumb=$r["thumb"];
         $desce=$r["desce"];
         $status=$r["status"];
         $title=$r["title"];
         $id=$r["id"];
      ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-circle-dot" style="<?php if($status == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($status == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?php echo $status; ?></span></div>
            <div><i class="fas fa-calendar"></i><span>12-10-2025</span></div>
         </div>
         <div class="thumb">
            <span>
            <?php 
        
        $query1="select * from tblcontent where pid='$id'";
        $result1=mysqli_query($con,$query1);
        $total=mysqli_num_rows($result1);
        echo $total;  
        ?> 
            </span>
            <img src="../upload/<?php echo $thumb; ?>" alt="">
         </div>
         <h3 class="title"><?php echo $title; ?></h3>
         <p class="description"><?php echo $desce; ?></p>
         <form action="" method="post" class="flex-btn">
           
         <a href="update_playlist.php?update=<?php echo $r["id"]; ?>" class="option-btn">update</a>
         <a href="delete_playlist.php?rm=<?php echo $r["id"]; ?>" class="delete-btn" onclick="return confirm('delete this playlist?');" >delete</a>
            
      </form>
         <a href="view_playlist.php?view=<?php echo $r["id"]; ?>" class="btn">view playlist</a>
      </div>
      <?php
      }
      ?>

   </div>

</section>
<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

<!-- <script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script> -->

</body>
</html>