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
  <meta name="author" content="">

  <title>New post - YouBee Blog Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-blog-template.css" rel="stylesheet">

  <style>
    body {
      background-color: #f5f5f5;
    }

    .newpost {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: 30px;
    }

    h1 {
      margin-bottom: 30px;
      color: #333;
      text-align: center;
    }

    .form-group label {
      font-weight: bold;
      color: #555;
    }

    .form-control {
      border-radius: 8px;
      padding: 10px;
      font-size: 16px;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 10px 25px;
      font-size: 16px;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .newpost-form {
      max-width: 700px;
      margin: auto;
    }

    .error-message {
      color: red;
      font-weight: bold;
      text-align: center;
      margin-top: 15px;
    }
  </style>

</head>

<body>

  <!-- Navigation -->
  <?php require "components/nav.php"; ?>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 newpost">

        <!-- Title -->
        <h1>New Post</h1>

        <!-- Newpost form -->
        <form action="actions/newpostAction.php" method="post" class="newpost-form">
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="form-control">
          </div>

          <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="5" id="content" name="content" class="form-control"></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Post</button>
        </form>

        <!-- Error Message -->
        <?php 
          if (isset($_GET['err'])) {
            echo '<p class="error-message">';
            if ($_GET['err'] == 0) {
              echo 'Error posting. Contact administrator';
            } else if ($_GET['err'] == 1) {
              echo 'Missing fields';
            }
            echo '</p>';
            $_SESSION["subject"] = "";
            $_SESSION["content"] = "";
          }
        ?>

      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include "components/footer.php"; ?>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
