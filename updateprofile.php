<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
    <meta name="author" content="">

    <title>About - YouBee Blog Template</title>

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

        <div class="col-lg-12">

          <!-- Title -->
          <h1>Update Profile</h1>

          <hr>

          <!-- Post Content -->
         <a  class="btn btn-default" href="changeprofile.php" >Change profile picture</a>
         <a  class="btn btn-default" href="changepassword.php" >Change Password</a>
         <a  class="btn btn-default" href="changeinfo.php" >Change info</a>


          <hr>

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
