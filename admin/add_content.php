<?php
require("../connect.php");
error_reporting(0);
session_start();
$email=$_SESSION["email"];
// $query="select * from tbltutor where email='$email'";
$query="select * from tbltutor where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$tutorid=$r["id"];
//$pid=$r["p.id"];
//$tutorid=$r["tutorid"];


$targetdir="../upload/";
$videotarget="../upload/";
 if($_POST["submit"])
 {

    if(!empty($_FILES["vthumb"]["name"] && $_FILES["video"]["name"]))
    {
       $filename=basename($_FILES["vthumb"]["name"]);
       $videoname=basename($_FILES["video"]["name"]);
       $targetfile=$targetdir.$filename;
       $videotargetfile=$videotarget.$videoname;
       $filetype=pathinfo($targetfile,PATHINFO_EXTENSION);
       $videofiletype=pathinfo($videotargetfile,PATHINFO_EXTENSION);
       $allow=array("jpg","png","jpeg");
       if(in_array($filetype,$allow))
       {
          if(move_uploaded_file($_FILES["vthumb"]["tmp_name"],$targetfile) && move_uploaded_file($_FILES["video"]["tmp_name"],$videotargetfile))
          {
            $tutorid=$tutorid;
           $pid=$_POST["playlist"];
            $vtitle=$_POST["title"];
            $vdesce=$_POST["desce"];
            $status=$_POST["status"];
            $query="insert into tblcontent(tutorid,pid,vtitle,vdesce,video,vthumb,status)values('$tutorid','$pid','$vtitle','$vdesce','$videoname','$filename','$status')";
            mysqli_query($con,$query);
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
   <title>add_content</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">

</head>
<body>

<?php include '../component/admin_header.php'; ?>
   
<section class="video-form">

   <h1 class="heading">upload content</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <p>video status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>-- select status</option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>video title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="enter video title" class="box">
      <p>video description <span>*</span></p>
      <textarea name="desce" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"></textarea>
      <p>video playlist <span>*</span></p>
      <select name="playlist" class="box" required>
      <option value="" selected disabled>-- select playlist</option>
         <?php $query="select * from tblplaylist where email='$email'";
            $result=mysqli_query($con,$query);
            while($r=mysqli_fetch_array($result))
            {
               ?>
         <option value="<?php echo $r["id"];?>"><?php echo $r["title"]; ?></option>
         <?php }
         ?>
      </select>
      <p>select thumbnail <span>*</span></p>
      <input type="file" name="vthumb"  required class="box">
      <p>select video <span>*</span></p>
      <input type="file" name="video" accept="video/*" required class="box">
      <input type="submit" value="upload video" name="submit" class="btn">
   </form>

</section>

<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>


