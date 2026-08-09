<?php
require('../connect.php');

error_reporting(0);

$up=$_GET['update'];
$query="select * from tblplaylist where id='$up'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$title=$r["title"];
$desce=$r["desce"];
$status=$r["status"];
$thumb=$r["thumb"];


$targetdir="../upload/";

if(isset($_POST["update"]))
{
   if(!empty($_FILES["papthumb"]["name"]))
    {
       $filename=basename($_FILES["papthumb"]["name"]);
       $targetfile=$targetdir.$filename;
       $filetype=pathinfo($targetfile,PATHINFO_EXTENSION);
       $allow=array("jpg","png","jpeg");
       if(in_array($filetype,$allow))
       {
          if(move_uploaded_file($_FILES["papthumb"]["tmp_name"],$targetfile))
          {
            $aptitle=$_POST["paptitle"];
            $apdesce=$_POST["papdesce"];
            $apstatus=$_POST["papstatus"];
            $query="update tblplaylist set title='$aptitle',status='$apstatus',desce='$apdesce',thumb='$filename' where id='$up'";
            mysqli_query($con,$query);
            if(isset($_POST["update"]))
            {
               header("location:playlists.php");
            }
          }
       }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">

</head>
<body>

<?php include '../component/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">update playlist</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <p>update playlist status <span>*</span></p>
      <select name="papstatus" class="box" required>
      <option value="<?php echo $status;?>" selected><?php echo $status;?></option>
      <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
     <p>update playlist title <span>*</span></p>
      <input type="text" name="paptitle" maxlength="100" value="<?php echo $title;?>" class="box">
      <p>update playlist description <span>*</span></p>
      <textarea name="papdesce" class="box" placeholder="write description" maxlength="1000" cols="30" rows="10"><?php echo $desce; ?></textarea>
      </select>
      <p>update playlist thumbnail <span>*</span></p>
      <div class="thumb">
         <span>
         <?php 
          $query1="select * from tblcontent where pid='$up'";
          $result1=mysqli_query($con,$query1);
          $total=mysqli_num_rows($result1);
          echo $total;  
        ?> 
         </span>
         <img src="../upload/<?php echo $thumb; ?> ?>" alt="">
      </div>
      <input type="file" name="papthumb"  class="box">
     <input type="submit" value="update playlist" name="update" class="btn">
   </form>

</section>

<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>

