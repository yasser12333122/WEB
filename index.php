<?php 
require("connection.php");

$sql=" 
SELECT p.id as posts_id,
       p.content,
       p.subject,
       p.date_created,
       u.id as user_id,
       u.name as user_name,
       u.profile
FROM `posts` as p 
INNER JOIN users as u on u.id=p.user_id 
WHERE p.deleted_at IS NULL 
ORDER BY p.date_created DESC
";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home - YouBee Blog Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-blog-template.css" rel="stylesheet">

  <!-- Inline Styles -->
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
</head>

<body>

<!-- Navigation -->
<?php require "components/nav.php"; ?>

<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-md-12">

      <!-- Posts Loop -->
      <?php 
      foreach ($posts as $post) {
          $date = new DateTime($post['date_created']);
          $formattedate = $date->format("F j, Y \a\\t g:i A");

          echo '
          <div class="post-container">
            <h2 class="post-title">
              <img src="imgs/' . $post["profile"] . '" alt="Profile Picture" class="profile-img">
              <a href="post.php?id=' . $post["posts_id"] . '">' . $post["subject"] . '</a>
            </h2>

            <a href="author.php?id=' . $post["user_id"] . '" class="lead">by ' . $post["user_name"] . '</a>
            <p><span class="glyphicon glyphicon-time"></span> Posted on ' . $formattedate . '</p>
            <p class="content">' . $post["content"] . '</p>

           <!-- <a class="btn btn-default" href="post.php?id=' . $post["posts_id"] . '">Read More</a> -->
  <!-- <a class="btn btn-default" href="post.html">Read Later</a> -->
          </div>';
      }
      ?>

      <!-- Pager -->
      <ul class="pager">
        <li class="previous"><a href="#">Prev</a></li>
        <li class="next"><a href="#">Next</a></li>
      </ul>

    </div>
  </div>
</div>

<!-- Footer -->
<?php include "components/footer.php"; ?>

<!-- Scripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
