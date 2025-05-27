<?php 
session_start();
require("connection.php");
require("components/checkifnotlogin.php");
$id=$_SESSION["userid"];
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
          <form action="actions/changepasswordAction.php" method="post" class="signup-form" >
            <div class="form-group">
              <label for="username">old Password</label>
              <input type="password" id="username" name="oldpass" class="form-control"  required>
            </div>

            <div class="form-group">
              <label for="username">New password</label>
              <input type="password" id="email" name="newpass" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">change password</button>
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
                            echo ' old password is wrong';
                        } else if($_GET['err'] == 3){
                            echo 'Password should be 8 characters minimum';
                        } else if($_GET['err'] == 0){
                            echo 'error cant chnage pass';
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
