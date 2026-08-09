<?php
require("../connect.php");
error_reporting(0);
session_start();

$email=$_SESSION["email"];
$targetdir="../images/";
$up=$_GET["update"];
$query="select * from tbltutor where id='$up'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
//$userid=$r["userid"];
$name=$r["name"];
$email=$r["email"];
$pass=md5($r["pass"]);

if(isset($_POST["update"]))
{
   if(!empty($_FILES["image"]["name"]))
      {
         $filename=basename($_FILES["image"]["name"]);
         $targetfile=$targetdir.$filename;
         $filetype=pathinfo($targetfile,PATHINFO_EXTENSION);
         $allow=array("jpg","png","jpeg");
         if(in_array($filetype,$allow))
         {
            if(move_uploaded_file($_FILES["image"]["tmp_name"],$targetfile))
            {
               $name1=$_POST["name1"];
              
               $oldpass=md5($_POST["oldpass"]);
               $npass=$_POST["npass"];
               $cpass=md5($_POST["cpass"]);
                  $query="update tbltutor set name='$name1',pass='$cpass',image='$filename' where id='$up'";
                  $r=mysqli_query($con,$query);
                  if($r)
                  {
                     header("location:../component/admin_logout.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/user_style.css">
<script>
       function validation()
      {
        
        var pass=document.getElementById("npass").value;
        var cpass=document.getElementById("cpass").value;
        if(pass != cpass)
        {
          document.getElementById("ucpass").innerHTML=" ** password are not matching";
          return false;
        }
      }
      </script>
</head>
<body>
<?php include '../component/admin_header.php'; ?>
<!-- header section end -->
<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <form action="" method="POST"  onsubmit="return validation()" enctype="multipart/form-data">
      <h3>update profile</h3>
      <div class="flex">
         <div class="col">
            <p>your name</p>
            <input type="text" name="name1" value="<?php echo $name;?>" maxlength="100" class="box">
            <p>your email</p>
            <input type="email" name="email" placeholder="" value="<?php echo $email;?>" maxlength="100" class="box" disabled>
            <p>update pic <span>*</span></p>
            <input type="file" name="image" accept="image/*" class="box" required>
         </div>
         <div class="col">
               <p>old password</p>
               <input type="password" name="oldpass" value="<?php echo $pass; ?>" maxlength="50" class="box" disabled>
              <p>new password <span>*</span></p>
               <input type="password" name="npass" id="npass" placeholder="enter your new password" maxlength="50" class="box" required>
               <p>confirm password <span>*</span></p>
               <input type="password" name="cpass" id="cpass" placeholder="confirm your new password" maxlength="50" class="box" required>
               <span id="ucpass" style="color:red;font-size: 1.8rem;"></span>
            </div>
      </div>
      <input type="submit" name="update" value="update profile" class="btn">
   </form>

</section>

<!-- footer section start -->
<?php include '../component/footer.php'; ?>
<!-- footer section ends -->
<script src="../js/script.js"></script>
</body>
</html>