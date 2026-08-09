<?php
require('connect.php');

error_reporting(0);

//use PHP Mailer & Exception
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'vendor/autoload.php';

$targetdir="images/";
if(isset($_POST['register']))
{
   $name=$_POST["name"];
  $email=mysqli_real_escape_string($con,$_POST["email"]);
   $pass=md5($_POST['pass']);
   // $image=$_POST["image"];
   $select="select * from tbluser where email='$email'";

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
      session_start();
      $_SESSION["name"]=$name;
      $_SESSION["email"]=$email;
      $_SESSION["pass"]=$pass;
      $_SESSION["image"]=$filename;
       // Generate OTP And Store in Session
       $_SESSION['otp'] = rand(100000, 999999);
       $_SESSION['otp_expiry'] = time() + 300; // OTP valid for 5 minutes

       if (sendOTPEmail($email, $_SESSION['otp'])) { 
         // calling SendOTPEmail function to send OTP
         echo "<script>alert('OTP sent successfully! Check your email.');
          window.location.href = 'verify_otp.php';</script>";
     }
      else {
         echo "<script>alert('Failed to send OTP. Try again.');</script>";
     }
   }
}
}
}
}

function sendOTPEmail($to, $otp) {
   $mail = new PHPMailer(true);

   try {
       // SMTP Configuration
       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com'; // email provider
       $mail->SMTPAuth = true;
       $mail->Username = 'neelpatel6340@gmail.com'; // Your email address or Host email address
       $mail->Password = 'knko nchc emxd oxni'; // Your email password or app password  from Google App Password 
       $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
       $mail->Port = 587;

       // Sender & Recipient
       $mail->setFrom('neelpatel6340@gmail.com', 'LMS_Demo_App');  
       $mail->addAddress($to);

       // Email Content
       $mail->isHTML(true);
       $mail->Subject = 'Your OTP Code';
       $mail->Body = "
           <div style='font-family: Arial, sans-serif; color: #333; padding: 20px;'>
               <h2>Your OTP Code</h2>
               <p>Your OTP for registration is: <strong style='font-size: 18px; color: #4CAF50;'>$otp</strong></p>
               <p>This OTP is valid for 5 minutes.</p>
               <p>If you did not request this, please ignore this email.</p>
               <p>Best Regards,<br>Your Website Team</p>
           </div>
       ";
      // Send email
       return $mail->send();
   } catch (Exception $e) {
       return false;
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/adminmain.css">
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

   <form class="register" action="" method="POST" onsubmit="return validation()" enctype="multipart/form-data">
      <h3>create account</h3>
      <div class="flex">
         <div class="col">
            <p>your name <span>*</span></p>
            <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email"  required class="box">
         </div>
         <div class="col">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" id="pass" placeholder="enter your password" maxlength="20" required class="box">
            <p>confirm password <span>*</span></p>
            <input type="password" name="cpass" id="cpass" placeholder="confirm your password" maxlength="20" required class="box">
            <span id="ucpass" style="color:red;font-size: 1.8rem;"></span>
         </div>
      </div>
      <p>select pic <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">already have an account? <a href="login.php">login now</a></p>
      <input type="submit" name="register" value="register now" class="btn">
   </form>

</section>

</body>
</html>