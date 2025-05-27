<?php 
session_start();
require("components/checkifnotlogin.php");
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
";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":id",$id);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$post ){
  die("post doesnt exist");
}

if($_SESSION["userid"] == $post["user_id"]){ // iza id lal session nafs id lal user be 2aleb table posts ya3ne hyda elo
    $isprofileowner=true ; 
  } else{
    $isprofileowner=false; 
    
  }

  if(! $isprofileowner){
    die("no access");
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
    <meta name="author" content="">

    <title>Edit post</title>

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

        <!-- Newpost content  -->
        <div class="col-lg-12 newpost">

          <!-- Title -->
          <h1>New post</h1>

          <!-- Newpost form -->
          <form action="actions/editpostAction.php?id=<?php echo $post["posts_id"]; ?>" method="post" class="newpost-form">
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" id="subject" name="subject"   value="<?php echo  $post["subject"]  ?> "  class="form-control">
            </div>

            <div class="form-group">
              <label for="content">Content</label>
              <textarea rows="5" id="content" name="content" class="form-control"  ><?php echo  $post["content"]  ?> </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
          </form>
          <p style="color:red">
                    <?php 
                    if(isset($_GET['err'])){
                        if($_GET['err'] == 0){
                            echo 'Error posting. Contact adminstartior';
                        } else if($_GET['err'] == 1){
                            echo 'Missing fields';
                        }
                        $_SESSION["subject"]="";
                        $_SESSION["content"]="";
                    }
                    ?>
          <!-- /form -->
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
