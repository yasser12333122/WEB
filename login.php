<?php
session_start();
require("components/checkiflogin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="">

  <title>Login - YouBee Blog Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-blog-template.css" rel="stylesheet">

  <!-- Custom Inline CSS -->
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login {
      background-color: #ffffff;
      border: 1px solid #ddd;
      padding: 30px;
      margin-top: 50px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .login h1 {
      font-size: 32px;
      margin-bottom: 25px;
      text-align: center;
    }

    .login-form .form-group label {
      font-weight: 600;
      margin-bottom: 5px;
      display: block;
    }

    .login-form input.form-control {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ced4da;
      margin-bottom: 15px;
    }

    .login-form .btn {
      width: 100%;
      padding: 10px;
      font-weight: bold;
      border-radius: 5px;
    }

    .login-form p {
      margin-top: 15px;
      text-align: center;
    }

    .login-form a {
      color: #007bff;
      text-decoration: none;
    }

    .login-form a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: #a94442;
      background-color: #f2dede;
      border: 1px solid #ebccd1;
      padding: 10px;
      margin-top: 15px;
      border-radius: 5px;
      font-weight: 500;
      text-align: center;
    }

    footer {
      margin-top: 50px;
      padding: 20px 0;
      background-color: #f1f1f1;
      text-align: center;
      border-top: 1px solid #ddd;
    }
  </style>

</head>

<body>

  <!-- Navigation -->
  <?php require "components/nav.php"; ?>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-2"></div>

      <!-- Login content -->
      <div class="col-lg-8 login">

        <!-- Title -->
        <h1>Login</h1>

        <!-- Login form -->
        <form action="actions/loginAction.php" method="post" class="login-form">
          <div class="form-group">
            <label for="username">Email</label>
            <input type="email" id="username" name="email" value="<?php echo $_SESSION["email"]; ?>" class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="pass" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary">Log in</button>
          <p>Don't have an account? <a href="signup.php">Sign Up Now</a></p>
        </form>

        <!-- Error Message -->
        <?php 
          if (isset($_GET['err'])) {
            if ($_GET['err'] == 1) {
              echo '<div class="error-message">Missing Parameters</div>';
            } else if ($_GET['err'] == 2) {
              echo '<div class="error-message">Wrong email or password</div>';
            } else if ($_GET['err'] == 3) {
              echo '<div class="error-message">Failed to log in. Contact admin.</div>';
            }
          }
          $_SESSION["email"] = "";
        ?>

      </div>

      <div class="col-lg-2"></div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright &copy; Blog @2024</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
