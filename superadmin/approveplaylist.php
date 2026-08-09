<?php
require("../connect.php");
error_reporting(0);
$email=$_COOKIE["email"];
$query="select * from tbladmin where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);

$adminid=$r["id"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>approve playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">
   <script src="../jquery-3.6.0.min.js"></script>
   <script src="../js/search.js"></script>
</head>
<body>

<?php include '../component/superadmin_header.php'; ?>
<section class="contents" id="myTable">

   <h1 class="heading">your playlist</h1>

   <div class="box-container">



   <?php
       //$query="select t.*,p.*,c.* from tbltutor t,tblplaylist p,tblcontent c where t.id=p.tutorid and p.id=c.pid and t.email='$email'";
       $query="select t.*,p.* from tblplaylist p,tbltutor t where p.tutorid=t.id order by p.id desc";
       $result=mysqli_query($con,$query);
       while($r=mysqli_fetch_array($result)){
         $thumb=$r["thumb"];
        $name=$r["name"];
         $status=$r["status"];
         $title=$r["title"];
         $image=$r["image"];
         $pid=$r["id"];
         $approvestatus=$r["approvestatus"];
      ?>
   
      <div class="box">
         <div class="flex">
            
         <img src="../images/<?php echo $image; ?>" alt="" height="30px">
         <h3 class="title"><?php echo $name;?></h3>
       
         <div><i class="fas fa-circle-dot" style="<?php if($approvestatus == 'approve'){echo 'color:limegreen'; }else if($approvestatus=="dismiss"){echo 'color:red';}  else {echo 'color:gold';} ?>"></i><span style="<?php if($approvestatus == 'approve'){echo 'color:limegreen'; }else if($approvestatus=="dismiss"){echo 'color:red';} else {echo 'color:gold';} ?>"><?php echo $approvestatus; ?></span></div>
            
        
         </div>
        
         <img src="../upload/<?php echo $thumb; ?>" class="thumb" alt="">
         <h3 class="title"><?php echo $title;?></h3>
        
         <form action="" method="POST" class="flex-btn">
            
         <a href="approvepl.php?id=<?php echo $r["id"];?>" class="option-btn">approve</a>
         <a href="delete_pl.php?rm=<?php echo $r["id"]; ?>" onclick="return confirm('delete this playlist?');" class="delete-btn">dismiss</a>
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
<script src="../js/script.js"></script>
</body>
</html>