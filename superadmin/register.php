<?php
require('../connect.php');

error_reporting(0);

if(isset($_POST['register']))
{
   $name=$_POST["name"];
   $profession=$_POST["profession"];
   $email=mysqli_real_escape_string($con,$_POST['email']);
   $pass=md5($_POST['pass']);
   $image=$_POST["image"];
   $select="select * from tbladmin where email='$email'";

   $result=mysqli_query($con,$select);
  
   if(mysqli_num_rows($result) >0){
     $message[] = 'user already exsist';
    
    
   }
   else
   {
   $insert="insert into tbladmin(name,profession,email,pass,image)values('$name','$profession','$email','$pass','$image')";
   mysqli_query($con,$insert);
    header('Location:../superadmin/login.php');
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
    <title>register</title>
    <script>
       function validation()
      {
        
        var pass=document.getElementById("pass").value;
        var cpass=document.getElementById("cpass").value;
        if(pass != cpass)
        {
          document.getElementById("ucpass").innerHTML=" ** password are not matching";
          return false;
        }
      }
      </script>
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

<form class="register" action="" method="POST"  onsubmit="return validation()">

   <h3>register new</h3>
   <div class="flex">
      <div class="col">
         <p>your name <span>*</span></p>
         <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
         <p>your profession <span>*</span></p>
         <select name="profession" class="box" required>
            <option value="" disabled selected>-- select your profession</option>
            <option value="admin">admin</option>
            
         </select>
         <p>your email <span>*</span></p>
         <input type="email" name="email" placeholder="enter your email" maxlength="20" required class="box">
      </div>
      <div class="col">
         <p>your password <span>*</span></p>
         <input type="password" name="pass" id="pass" placeholder="enter your password" maxlength="20" required class="box">
         <p>confirm password <span>*</span></p>
         <input type="password" name="cpass" id="cpass" placeholder="confirm your password" maxlength="20" required class="box">
         <span id="ucpass" style="color:red;font-size: 1.8rem;"></span>
         <p>select pic <span>*</span></p>
         <input type="file" name="image" accept="image/*" required class="box">
      </div>
   </div>
   <p class="link">already have an account? <a href="login.php">login now</a></p>
   <input type="submit" name="register" value="register now" class="btn">
</form>

</section>

<!-- registe section ends -->

</body>
</html>