<?php
session_start();
require('connect.php');
error_reporting(0);

if(isset($_POST["verify_otp"]))
{
    $entered_otp = $_POST['otp'];
    if ($_SESSION['otp'] == $entered_otp && time() < $_SESSION['otp_expiry'])
    {
        $name=$_SESSION["name"];
        $email=$_SESSION["email"];
        $pass=$_SESSION["pass"];
        $image=$_SESSION["image"];

        $insert="insert into tbluser(name,email,pass,image)values('$name','$email','$pass','$image')";
         $resultans=mysqli_query($con,$insert);
         if($resultans){
            echo "<script>alert('Registration successful!');</script>";
            header('Location:login.php');
            session_destroy();
         }
        
    }
    else {
        echo "<script>alert('Invalid OTP or OTP expired.');</script>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="css/user_style.css">
</head>
<body style="padding-left: 0;">
    <section class="form-container">
        <form class="verify-otp" action="" method="POST">
            <h3>Verify OTP</h3>
           
            <input type="email" value="<?php echo $_SESSION["name"]; ?>" disabled class="box">       
            <input type="number" name="otp" placeholder="Enter OTP" required class="box">
            <input type="submit" name="verify_otp" value="Verify OTP" class="btn">
        </form>
    </section>
</body>
</html>