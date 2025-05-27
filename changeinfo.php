<?php 
session_start();
require("connection.php");
require("components/checkifnotlogin.php");
$id=$_SESSION["userid"];
$sql="SELECT id,name,email from users WHERE id=$id";
$stmt=$pdo->query($sql);
$user=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
    <meta name="author" content="YouBee.ai">

    <title>Sign up -  Template</title>

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

        <div class="col-lg-2"></div>

        <!-- Signup content  -->
        <div class="col-lg-8 signup">

          <!-- Title -->
          <h1>Sign up</h1>

          <!-- Login form -->
          <form action="actions/editinfoAction.php" method="post" class="signup-form" >
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="name" class="form-control" value="<?php echo $user["name"] ?>" required>
            </div>

            <div class="form-group">
              <label for="username">Email</label>
              <input type="email" id="email" name="email" class="form-control" value="<?php echo $user["email"] ?>" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="pass" class="form-control"  required>
            </div>
            <button type="submit" class="btn btn-primary">change</button>
          </form>
          <p style="color:red">
          <p style="color:red">
                    <?php 
                    if(isset($_GET['err'])){
                        if($_GET['err'] == 0){
                            echo 'Error editing . Contact adminstartior';
                        } else if($_GET['err'] == 1){
                            echo 'Missing fields';
                        } else if($_GET['err'] == 2){
                            echo 'Invalid Email Address';
                        } else if($_GET['err'] == 3){
                            echo 'Password should be 8 characters minimum';
                        } else if($_GET['err'] == 4){
                            echo 'Email Address already in use';
                        }  else if($_GET['err'] == 6){
                            echo 'Wrong password';
                    }
                }
                  

                ?>
          <!-- /form -->
        </div>

        <div class="col-lg-2"></div>

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
