<?php
session_start();
require "../connection.php"; 
require("../components/checkifnotlogin.php");

if($_SERVER["REQUEST_METHOD"] !="POST"){
    die("WRONG METHOD");
}

$oldpassword=(trim($_POST["oldpass"]));
$newpass=(trim($_POST["newpass"]));

if(!isset ($oldpassword) || empty($oldpassword)
|| !isset($newpass) || empty($newpass)){
 header("Location:../changepassword.php?err=1");
    exit();
}
    $id=$_SESSION["userid"];
    $sql="SELECT  password FROM  users WHERE id=$id";
    $stmt=$pdo->query($sql);
    $user= $stmt->fetch(PDO:: FETCH_ASSOC);
 
 if(password_verify($oldpassword,$user["newpass"])){
    header("Location:../changepassword.php?err=2");
    exit();

 } 
 if(strlen($newpass)<8){
    header("Location:../changepassword.php?err=3");
    exit();
  
 }
 $hashednewpass=password_hash($newpass,PASSWORD_BCRYPT);
 try{
    $sql="UPDATE  users SET password =:password WHERE id=:id ";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":password",$hashednewpass);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    header("Location:../index.php?");

    




 } catch(PDOException $ex){
    header("Location:../chnagepassword.php?err=-0");
    exit();


 }

