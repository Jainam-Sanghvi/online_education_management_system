<?php
require("../connect.php");
error_reporting(0);
session_start();
$email= $_SESSION['email'];

$query="select * from tbltutor where email='$email'";
$result=mysqli_query($con,$query);
$r=mysqli_fetch_array($result);
$name=$r["name"];
$id=$r["id"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>liked videos</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   
   <link rel="stylesheet" href="../css/adminmain.css">
   <script src="../jquery-3.6.0.min.js"></script>
    <script src="../js/search.js"></script>

    <style>        
      
    .liked-videos .box-container{
                display: grid;
                grid-template-columns: repeat(auto-fit, 35rem);
                gap: 1.5rem;
                align-items: flex-start;
                justify-content: center;
                text-overflow: hidden;
                }

                .liked-videos .box-container .box{
                background-color: var(--white);
                border-radius: .5rem;
                padding: 2rem;
                overflow-x: hidden;
                }

                .liked-videos .box-container .box .tutor{
                margin-bottom:2rem;
                display: flex;
                align-items: center;
                gap: 1.5rem;
                }

                .liked-videos .box-container .box .tutor img{
                height: 5rem;
                width: 5rem;
                border-radius: 50%;
                object-fit: cover;
                }

                .liked-videos .box-container .box .tutor h3{
                font-size: 1.8rem;
                color: var(--black);
                margin-bottom: .2rem;
                }

                .liked-videos .box-container .box .tutor span{
                font-size: 1.5rem;
                color: var(--light-color);
                }

                .liked-videos .box-container .box .thumb{
                width: 100%;
                height: 20rem;
                object-fit: cover;
                border-radius: .5rem;
                margin-bottom: 1rem;
                }

                .liked-videos .box-container .box .title{
                font-size: 2rem;
                color: var(--black);
                padding: .5rem 0;
                text-overflow: ellipsis;
                overflow-x: hidden;
             
               }

               .empty{
                  background-color: var(--white);
                  border-radius: .5rem;
                  padding: 1.5rem;
                  text-align: center;
                  width: 100%;
                  font-size: 2.2rem;
                  color: var(--red);
               }     
        </style>
</head>
<body>

<?php include '../component/admin_header.php'; ?>

<!-- courses section starts  -->

<section class="liked-videos" id="myTable">

   <h1 class="heading">liked videos</h1>

   <div class="box-container">

   <?php
     $query="select l.*,c.*,t.* from tbllike l,tblcontent c,tbltutor t where l.cid=c.cid and c.tutorid=t.id and l.tutorid='$id'";
     $result=mysqli_query($con,$query);
     if(mysqli_num_rows($result) > 0){
     while($r=mysqli_fetch_array($result)){
       $name=$r["name"];
       $image=$r["image"];
      $vthumb=$r["vthumb"];
      $vtitle=$r["vtitle"];
    ?>
   <div class="box">
      
      <img src="../upload/<?php echo $vthumb; ?>" alt="" class="thumb">
      <h3 class="title"><?php echo $vtitle; ?></h3>
      <form action="" method="POST" class="flex-btn">
        <a href="view_content.php?view=<?php echo $r["cid"]; ?>" class="inline-btn">watch video</a>
         </form>
   </div>
   <?php
            }
         }
         else
         {
            echo '<p class="empty">nothing added to likes yet !</p>';
         }
   ?>

   </div>

</section>
<?php include '../component/footer.php'; ?>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>