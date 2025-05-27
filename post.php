<?php 
session_start();
require("connection.php");
$id=htmlspecialchars($_GET["id"]);
$sql=" 
SELECT p.id as posts_id
,p.content,
p.subject,
p.date_created,
u.id as user_id,
u.name as user_name
FROM `posts` as p INNER JOIN users as u on u.id=p.user_id  
WHERE p.id=:id
AND  p.deleted_at IS NULL 
";
 $stmt=$pdo->prepare($sql);
$stmt->bindParam(":id",$id);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$post ){
  die("post doesnt exist");
}
$date=new DateTime($post ['date_created']);
$formattedate=$date->format(" F j, Y \a\\t g:i A");

if($_SESSION["userid"] == $post["user_id"]){ // iza id lal session nafs id lal user be 2aleb table posts ya3ne hyda elo
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

    <title>Post - YouBee Blog Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-blog-template.css" rel="stylesheet">

  </head>

  <body>

  <?php
require "components/nav.php";

?>


    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-12">

          <!-- Blog Post -->

          <!-- Title -->
           
          <h1 class="post-title"><?php echo $post ["subject"] ?> </h1>

          <!-- Author -->
          <a href="author.php?id=<?php echo $post["user_id"];?>" class="lead">
            by <?php echo $post["user_name"]; ?>
          </a>

          <hr>

          <!-- Date/Time -->
          <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $formattedate ?></p>

          <hr>

          <!-- Post Content -->
          <p><?php
             $date=new DateTime($post ['date_created']);
             $formattedate=$date->format(" F j, Y \a\\t g:i A");
          echo $post["content"] ?></p>
          <hr>
<?php 
if($isprofileowner==true){
  echo  ' 
  <a class="btn btn-default" href="editpost.php?id=' . $post["posts_id"]  .  '">Edit </a>
  <a class="btn btn-default" href="actions/deletepostAction.php?id=' . $post["posts_id"]  .  '"> Delete</a>
  ' ;
}  elseif ( isset ($_SESSION["loggedIn"] )&& $_SESSION["loggedIn"]==true){
  echo '<a class="btn btn-default" href="post.html">Like</a> ';
}
  ?>

  
          <hr>


          <!-- Blog Comments -->

          <!-- Comments Form -->
          <div class="well">
            <h4>Leave a Comment:</h4>
            <form role="form">
              <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>

          <hr>

          <!-- Posted Comments -->

          <!-- Comment -->
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
              <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2024 at 9:30 PM</small>
              </h4>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
          </div>

          <!-- Comment -->
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
              <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2024 at 9:30 PM</small>
              </h4>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              <!-- Nested Comment -->
              <div class="media">
                <a class="pull-left" href="#">
                  <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                  <h4 class="media-heading">Nested Start Bootstrap
                    <small>August 25, 2024 at 9:30 PM</small>
                  </h4>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>
              <!-- End Nested Comment -->
            </div>
          </div>

        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; YouBee Blog @2024</p>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
      </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
  </body>

</html>
