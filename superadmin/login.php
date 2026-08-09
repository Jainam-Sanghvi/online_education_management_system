<?php
require("../connect.php");
error_reporting(0);

session_start();

if(isset($_POST["submit"]))
{
   
   $email=mysqli_real_escape_string($con,$_POST["email"]);
   $pass=md5($_POST['pass']);
   
   $select="select * from tbladmin where email='$email' and pass='$pass'";
   $result=mysqli_query($con,$select);

   if(mysqli_num_rows($result)>0)
   {
      setcookie("email",$email,time()+1*24*60*60);
      header("location:../superadmin/admin.php");
   }
   else
   {
      $message[]="incorrect email and password";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/adminmain.css">
    <title>login</title>
</head>
<body style="padding-left: 0;">
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<section class="form-container">

<form action="" method="POST" enctype="multipart/form-data" class="login">
   <h3>welcome back!</h3>
   <p>your email <span>*</span></p>
   <input type="email" name="email" placeholder="enter your email" maxlength="20" required class="box">
   <p>your password <span>*</span></p>
   <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
  
   <input type="submit" name="submit" value="login now" class="btn">
</form>

</section>
</body>
</html>