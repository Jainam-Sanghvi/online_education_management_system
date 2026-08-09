<?php
require('../connect.php');

error_reporting(0);
$targetdir="../images/";
if(isset($_POST['register']))
{
   $name=$_POST["name"];
   $profession=$_POST["profession"];
   $email=mysqli_real_escape_string($con,$_POST['email']);
   $pass=md5($_POST['pass']);
   
   $select="select * from tbltutor where email='$email'";

   $result=mysqli_query($con,$select);
  
   if(mysqli_num_rows($result) >0){
     $message[] = 'user already exsist';
    
    
   }
   else
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
               $insert="insert into tbltutor(name,profession,email,pass,image)values('$name','$profession','$email','$pass','$filename')";
               mysqli_query($con,$insert);
               header('Location:../admin/login.php');
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

<form class="register" action="" method="POST"  onsubmit="return validation()" enctype="multipart/form-data">

   <h3>register new</h3>
   <div class="flex">
      <div class="col">
         <p>your name <span>*</span></p>
         <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
         <p>your profession <span>*</span></p>
         <select name="profession" class="box" required>
            <option value="" disabled selected>-- select your profession</option>
            <option value="developer">developer</option>
            <option value="desginer">desginer</option>
            <option value="musician">musician</option>
            <option value="biologist">biologist</option>
            <option value="teacher">teacher</option>
            <option value="engineer">engineer</option>
            <option value="lawyer">lawyer</option>
            <option value="accountant">accountant</option>
            <option value="doctor">doctor</option>
            <option value="journalist">journalist</option>
            <option value="photographer">photographer</option>
         </select>
         <p>your email <span>*</span></p>
         <input type="email" name="email" placeholder="enter your email"  required class="box">
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