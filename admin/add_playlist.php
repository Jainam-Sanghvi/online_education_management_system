<?php
require("../connect.php");
error_reporting(0);
session_start();
$email=$_SESSION["email"];
$query="select * from tbltutor where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$tutorid=$r["id"];

$targetdir="../upload/";
 if($_POST["submit"])
 {

    if(!empty($_FILES["thumb"]["name"]))
    {
       $filename=basename($_FILES["thumb"]["name"]);
       $targetfile=$targetdir.$filename;
       $filetype=pathinfo($targetfile,PATHINFO_EXTENSION);
       $allow=array("jpg","png","jpeg");
       if(in_array($filetype,$allow))
       {
          if(move_uploaded_file($_FILES["thumb"]["tmp_name"],$targetfile))
          {
           $email=$email;
            $status=$_POST["status"];
            $title=$_POST["title"];
            $desce=$_POST["desce"];
           $tutorid=$tutorid;
         
            $query="insert into tblplaylist(email,status,title,desce,thumb,tutorid)values('$email','$status','$title','$desce','$filename','$tutorid')";
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
   <title>Add Playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminmain.css">

</head>
<body>

<?php include '../component/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">create playlist</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <p>playlist status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>-- select status</option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
     <p>playlist title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="enter playlist title" class="box">
      <p>playlist description <span>*</span></p>
      <textarea name="desce" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"></textarea>
      <p>playlist thumbnail <span>*</span></p>
      <input type="file" name="thumb" required class="box">
      <!-- <input type="text" name="thumb" value="<//?php echo $tutorid ?>" class="box"> -->
      <input type="submit" value="create playlist" name="submit" class="btn">
   </form>

</section>

<?php include '../component/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>

