<?php 
session_start();
require("components/checkifnotlogin.php");
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
          <h1>Change image</h1>

          <!-- Login form -->
          <form action="actions/changeprofileAction.php" method="post" class="signup-form"  enctype="multipart/form-data">
            <div class="form-group">
              <label for="username">image</label>
              <input type="file"  name="profile"   class="form-control"  required >
              <button type="submit" class="btn btn-primary">upload</button>
            </div>
          </form>
          <p style="color:red">
          <p style="color:red">
                    <?php 
                    if(isset($_GET['err'])){
                        if($_GET['err'] == 0){
                            echo 'Error uploading . Contact adminstartior';
                        } else if($_GET['err'] == 1){
                            echo 'could not upload image ';
                        } else if($_GET['err'] == 2){
                            echo 'unsupported file extension';
                        } else if($_GET['err'] == 3){
                            echo 'image larger than excpected';
                        } else if($_GET['err'] == 4){
                            echo "not image ";
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
