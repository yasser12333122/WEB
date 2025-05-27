<?php
session_start();
require("../connection.php");
require("../components/checkifnotlogin.php"); // iza mano logged in ma t5ale yfoot 

if($_SERVER["REQUEST_METHOD"] !="POST"){
    die("WRONG METHOD");
   
}
$subject=htmlspecialchars(trim($_POST["subject"]));
$content=htmlspecialchars(trim($_POST["content"]));

$_SESSION["subject"]=$subject;
$_SESSION["content"]=$content;


if(!isset($subject) || empty($subject) ||
 !isset($content) || empty($content)){
    header("Location: ../newpost.php?err=1");
    exit();
 }
 try{
    $sql="INSERT into posts (subject,content,user_id) VALUES (:subject,:content,:user_id)";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":subject",$subject);
    $stmt->bindParam(":content",$content);
    $stmt->bindParam(":user_id", $_SESSION["userid"]);  
    $stmt->execute();
    header("Location: ../index.php");
    exit();


 } catch(PDOException $ex){
    header("Location: ../newpost.php?err=0");
    exit();


 }
