<?php 
session_start();


?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">YouBee Blog</a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="about.html">About</a>
            </li>
           
              <?php 
              if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]==true){
                echo '
                  <li>
              <a href="author.php?id=' . $_SESSION["userid"] . ' ">' . $_SESSION["name"]  . '</a>
            </li>';
            echo '
            <li>
        <a href="logout.php"> Log out</a>
      </li>';
      echo '
      <li>
  <a href="newpost.php"> New post</a>
</li>';
              } else{
                echo '
                <li>
            <a href="login.php"> Log in </a>
          </li>';
          echo '
          <li>
      <a href="signup.php"> signup</a>
    </li>';

              }
              ?>

            
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>
