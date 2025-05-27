<?php
session_start();
require "../connection.php"; 
require("../components/checkiflogin.php");

if($_SERVER["REQUEST_METHOD"] !="POST"){
    die("WRONG METHOD");
}

$name=htmlspecialchars(trim($_POST["name"]));
$email=htmlspecialchars(trim($_POST["email"]));
$password=htmlspecialchars(trim($_POST["pass"]));

if(!isset ($name) || empty($name)
|| !isset($email) || empty($email) ||
 !isset($password) || empty($password)){
    header("Location:../signup.php?err=1");
    exit();
 } 

 $_SESSION["email"]=$email;
 $_SESSION["name"]=$name;



 if(!filter_var($email ,FILTER_VALIDATE_EMAIL)){
    header("Location:../signup.php?err=2");
    exit();
 
 }
 if(strlen($password)<8){
    header("Location:../signup.php?err=3");
    exit();
  
 }

 $hashedPass = password_hash($password, PASSWORD_BCRYPT);
 try {
  
    $sql= "INSERT into users (name,password,email) VALUES (:name,:password,:email)";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":password",$hashedPass);
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $_SESSION["loggedIn"]=true;
    $_SESSION["userid"]=$pdo->lastInsertID();
    $_SESSION["name"]=$name;
    header ("Location:../index.php");


 }
 catch (PDOException $ex){
    if($ex->errorInfo[1]==1062){   // ya3ne email mawjod abel mano unique
        header("Location:../signup.php?err=4");     
    }
    die($ex->getMessage());
  
 }



?>
