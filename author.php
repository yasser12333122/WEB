<?php 
session_start();
require("connection.php");
$id= htmlspecialchars($_GET["id"]); //  s7abaet id le be aleb ur;

$sql=" SELECT name ,profile FROM users where id=:id";
$stmt=$pdo->prepare($sql);
$stmt->bindparam(":id",$id);
$stmt->execute();
$user= $stmt->fetch(PDO::FETCH_ASSOC);
$profile=$user["profile"];
if(!$user){
    die("no user found");
}

$sql=" 
SELECT p.id as posts_id
,p.content,
p.subject,
p.date_created
FROM posts p WHERE p.user_id = :id
ORDER BY p.date_created DESC
";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":id",$id);
$stmt->execute();
$posts=$stmt->fetchall(PDO::FETCH_ASSOC);

if($id == $_SESSION["userid"]){
  $isprofileowner=true ; 
} else{
  $isprofileowner=false; 
  
}





?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
    <meta name="author" content="">

    <title>Home - YouBee Blog Template</title>
    <style>
    body {
      background-color: #f1f1f1;
      font-family: Arial, sans-serif;
    }

    .post-title {
      display: flex;
      align-items: center;
      gap: 16px;
      font-size: 26px;
      font-weight: bold;
      margin-top: 30px;
    }

    .post-title a {
      color: #333;
      text-decoration: none;
    }

    .post-title a:hover {
      color: #007bff;
    }

    .post-container {
      background-color: #fff;
      border-radius: 12px;
      padding: 25px;
      margin-bottom: 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .post-container p {
      margin-bottom: 12px;
    }

    .content {
      font-weight: 500;
      background-color: #fdf3e7;
      border-left: 5px solid #d9a15b;
      padding: 15px;
      border-radius: 6px;
      color: #444;
    }

    .lead {
      font-size: 16px;
      color: #555;
    }

    .lead:hover {
      color: #000;
      text-decoration: none;
    }

    .btn {
      margin-right: 8px;
      margin-top: 10px;
    }

    .btn-default {
      background-color: #e7e7e7;
      color: #333;
      border: none;
    }

    .btn-default:hover {
      background-color: #ccc;
      color: #000;
    }

    .pager li a {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 8px 16px;
      border-radius: 5px;
      color: #333;
    }

    .pager li a:hover {
      background-color: #ddd;
    }

    img.profile-img {
      width: 63px;
      height: 63px;
      object-fit: cover;
      border-radius: 50%;
    }

    footer {
      margin-top: 50px;
      padding: 20px 0;
      background-color: #f9f9f9;
      text-align: center;
      border-top: 1px solid #ddd;
    }

    

    </style>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-blog-template.css" rel="stylesheet">


  </head>

  <body>

    <!-- Navigation -->
    <?php
require "components/nav.php";

?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">
         <!-- Page Title -->
        <div class="col-md-12">
          <a class="pull-left" href="#">
          <img class="media-object" src="imgs/<?php echo $profile; ?>" alt="" style="width: 63px; height: 63px; object-fit: cover; border-radius: 50%;">






    </a>
    
          <h2 class="count" > Posts by  <?php  echo  $user["name"]   ?> <?php 
          $count=count($posts);
          if  ($count>1) {
            echo  " ($count posts)";}
             elseif($count===1 ){
                echo "($count post)";
             }
        else {
                echo " (no posts)";
            }
          ?> 
          </h2>
          <div class="change" >
              <?php 
              if($isprofileowner==true){
              echo '
              <a  class="btn btn-default" href="updateprofile.php"  class="change-profile"> Change profile Info</a> ';
              }
              ?>
             </div>
              </div>
           
       
</div>
        <!-- Blog Entries Column -->
        <div class="col-md-12">

          <!-- First Blog Post -->
           <?php 
           foreach ($posts as $post ){
            $date=new DateTime($post ['date_created']);
        $formattedate=$date->format(" F j, Y \a\\t g:i A");
            echo ' 
          <h2 class="post-title">
            <a href="post.php?id=' .$post["posts_id"] . '"> ' . $post["subject"] .  '</a>
          </h2>
          <p><span class="glyphicon glyphicon-time"></span> Posted on  ' . $formattedate. '</p>
          <p>' . $post["content"] . ' </p>
          <a class="btn btn-default" href="post.php?id='. $post["posts_id"] . '">Read More</a>

          <hr>';
           }
           ?>

          
          
          <!-- Pager -->
          <ul class="pager">
            <li class="previous">
              <a href="#">Prev</a>
            </li>
            <li class="next">
              <a href="#">Next</a>
            </li>
          </ul>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php 
include "components/footer.php";
   ?>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>




  </body>

</html>
