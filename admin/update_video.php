<?php
require('../connect.php');

error_reporting(0);
session_start();
$email=$_SESSION["email"];
$up=$_GET['update'];
$query="select * from tblcontent where cid='$up'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$vtitle=$r["vtitle"];
$vdesce=$r["vdesce"];
$status=$r["status"];
$vthumb=$r["vthumb"];
$video=$r["video"];

$targetdir="../upload/";
$videotarget="../upload/";
if(isset($_POST["update"]))
{
   if(!empty($_FILES["apthumb"]["name"] && $_FILES["apvideo"]["name"]))
    {
       $filename=basename($_FILES["apthumb"]["name"]);
       $videoname=basename($_FILES["apvideo"]["name"]);
       $targetfile=$targetdir.$filename;
       $videotargetfile=$videotarget.$videoname;
       $filetype=pathinfo($targetfile,PATHINFO_EXTENSION);
       $videofiletype=pathinfo($videotargetfile,PATHINFO_EXTENSION);
       $allow=array("jpg","png","jpeg");
       if(in_array($filetype,$allow))
       {
          if(move_uploaded_file($_FILES["apthumb"]["tmp_name"],$targetfile) && move_uploaded_file($_FILES["apvideo"]["tmp_name"],$videotargetfile))
          {
            $aptitle=$_POST["aptitle"];
            $apdesce=$_POST["apdesce"];
            $apstatus=$_POST["apstatus"];
            $query="update tblcontent set vtitle='$aptitle',status='$apstatus',vdesce='$apdesce',vthumb='$filename',video='$videoname' where cid='$up'";
            //$query="insert into tblcontent(tutorid,pid,vtitle,vdesce,video,vthumb,status)values('$tutorid','$pid','$vtitle','$vdesce','$videoname','$filename','$status')";
            mysqli_query($con,$query);
            if(isset($_POST["update"]))
            {
               header("location:contents.php");
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
   <title>update video</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">
</head>
<body>

<?php include '../component/admin_header.php'; ?>
   
<section class="video-form">

   <h1 class="heading">update content</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <p>update status <span>*</span></p>
      <select name="apstatus" class="box" required>
         <option value="<?php echo $status;?>" selected><?php echo $status;?></option>
            <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>update video title <span>*</span></p>
      <input type="text" name="aptitle" maxlength="100" value="<?php echo $vtitle; ?>" required class="box">
      
      <p>update video description <span>*</span></p>
      <textarea name="apdesce" class="box"  maxlength="1000" cols="30" rows="10" ><?php echo $vdesce?></textarea>
      
      <img src="../upload/<?php echo $vthumb ?>" alt="">
      <p>update thumbnail <span>*</span></p>
      <input type="file" name="apthumb" class="box">
      <video src="../upload/<?php echo $video; ?>" controls></video>
      <p>update video <span>*</span></p>
      <input type="file" name="apvideo" accept="video/*"  class="box">
      <input type="submit" value="update video" name="update" class="btn">
   </form>

</section>

<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
