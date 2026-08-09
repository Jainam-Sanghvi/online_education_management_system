<?php

require("connect.php");
error_reporting(0);
$email=$_COOKIE["email"];
$query="select * from tbluser where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$userid=$r["userid"];

if(isset($_POST["submit"]))
{
   $name=$_POST["name"];
   $email=$_POST["email"];
   $number=$_POST["number"];
   $msg=$_POST["msg"];
   $query="insert into tblcontact(name,email,number,msg,userid)values('$name','$email','$number','$msg','$userid')";
   mysqli_query($con,$query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_style.css">
<script>
    function validation()
        {
          var name=document.getElementById("name").value;
        
          var number=document.getElementById("number").value;
          
          var msg=document.getElementById("msg").value;
          if(name == "")
          {
            document.getElementById("errname").innerHTML=" ** please fill the name feild";
            return false;
          }
          if(!isNaN(name))
          {
            document.getElementById("errname").innerHTML=" ** only chracters are allowed";
            return false;
          }
          if((name.length<=2)||(name.length > 20))
          {
            document.getElementById("errname").innerHTML=" ** user length must be between 2 and 20";
            return false;
          }
        
          if(number == "")
          {
            document.getElementById("mno").innerHTML=" ** please fill the mobile number feild";
            return false;
          }
          if(number.length != 10)
          {
            document.getElementById("mno").innerHTML=" ** mobile number must be 10 digits allowed";
            return false;
          }
         
        
        }
   </script>
</head>
<body>
<?php include 'component/user_header.php'; ?>
<!-- header section end -->

<!-- contact section starts  -->

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="POST" onsubmit="return validation()">
         <h3>get in touch</h3>
         <input type="text" id="name" placeholder="enter your name"  maxlength="100" name="name" class="box">
         <span id="errname" style="color:red;font-size: 1.8rem;"></span>
         <input type="email" placeholder="enter your email" required maxlength="100" name="email" class="box">
         <input type="number" id="number" placeholder="enter your number" maxlength="10" name="number" class="box">
         <span id="mno" style="color:red;font-size: 1.8rem;"></span>
         <textarea name="msg" id="msg" class="box" placeholder="enter your message" required cols="30" rows="10" maxlength="1000"></textarea>
       
         <input type="submit" value="send message" class="inline-btn" name="submit">
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>phone number</h3>
         <a href="">123-456-7890</a>
         <a href="">111-222-3333</a>
      </div>

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>email address</h3>
         <a href="">jainam@gmail.com</a>
         <a href="">mohitpatil123@gmail.com</a>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>office address</h3>
         <a href="#">branch 1 : katargam -- surat</a>
         <a href="#">branch 2 : vesu -- surat</a>
      </div>


   </div>

</section>

<!-- contact section ends -->


<!-- footer section start -->
<?php include 'component/footer.php'; ?>
<!-- footer section ends -->
<script src="js/script.js"></script>
</body>
</html>