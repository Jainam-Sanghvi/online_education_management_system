<?php
require("../connect.php");
error_reporting(0);
//use PHP Mailer & Exception
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require '../vendor/autoload.php';
if(isset($_POST["submit"]))
{
   $tutorid=$_GET["id"];
   
   $cpass=md5($_POST["cpass"]);
   
   $select="select * from tbltutor where id='$tutorid'";

   $result=mysqli_query($con,$select);
  
   $r=mysqli_fetch_array($result);
   $email=$r["email"];
   if(mysqli_num_rows($result)>0)
   {
      $query="update tbltutor set pass='$cpass' where id='$tutorid'";
      $result=mysqli_query($con,$query);
      if($result)
      {
         $message[]="password change sucessfully";
         sendEmail($email);
      }
     
   }
  
 
}


function sendEmail($to) {
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
       $mail->Subject = 'Change password';
       $mail->Body = "
           <div style='font-family: Arial, sans-serif; color: #333; padding: 20px;'>
               <h3>Dear tutor</h3>
               <h4>Your Password Change Sucessfully !! </h4>
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
    <title>forgetpasssword</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/adminmain.css">
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

   <form action="" method="POST"  class="login" onsubmit="return validation()">
      <h3>change password!</h3>
     <p>enter new password <span>*</span></p>
      <input type="password" name="pass" id="pass" placeholder="enter your password" maxlength="20" required class="box">
      <p>confirm new password <span>*</span></p>
      <input type="password" name="cpass" id="cpass" placeholder="enter your password" maxlength="20" required class="box">
      <span id="ucpass" style="color:red;font-size: 1.8rem;"></span>
      <p class="link">password changed ? <a href="login.php">login now</a></p>
      <input type="submit" name="submit" value="change password" class="btn">
      
   </form>

</section>



</body>
</html>