<?php
session_start();
require("../connection.php");
require("../components/checkifnotlogin.php"); // iza mano logged in ma t5ale yfoot 

if($_SERVER["REQUEST_METHOD"] !="POST"){
    die("WRONG METHOD");
   
}
$subject=htmlspecialchars(trim($_POST["subject"]));
$content=htmlspecialchars(trim($_POST["content"]));

if(!isset($subject) || empty($subject) ||
 !isset($content) || empty($content)){
    header("Location: ../editpost.php?err=1");
    exit();
 }
 $postid=htmlspecialchars($_GET["id"]); // hyda id post 
 $sql=" 
SELECT 
u.id as user_id
FROM `posts` as p INNER JOIN users as u on u.id=p.user_id  
WHERE p.id=:id
AND  p.deleted_at IS NULL 
";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":id",$postid);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$post) {
    die("Post not found or you do not have access.");
}

 if($_SESSION["userid"]== $post["user_id"]){ // 3emelt hyde la et2kd mn post ownwer 3ashen ma y3ade  ala posts le manon elo 
    $ispostowner=true ; 
  } else{
    $ispostowner=false; 
  }
  if(! $ispostowner){
    die("not post owenr");
  }
 try{
    $sql="UPDATE posts SET subject=:subject , content=:content   WHERE id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":subject",$subject);
    $stmt->bindParam(":content",$content);
    $stmt->bindParam(":id", $postid);  
    $stmt->execute();
    header("Location: ../index.php");
    exit();




 } catch(PDOException $ex){
    header("Location: ../newpost.php?err=0");
    exit();


 }
