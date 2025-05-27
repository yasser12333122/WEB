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
    header("Location:../changeinfo.php?err=1");
    exit();
 } 

 if(!filter_var($email ,FILTER_VALIDATE_EMAIL)){
    header("Location:../changeinfo.php?err=2");
    exit();
 
 }
 if(strlen($password)<8){
    header("Location:../changeinfo.php?err=3");
    exit();
  
 }



 $id=$_SESSION["userid"];
$sql="SELECT id,name,email,password from users WHERE id=$id";
$stmt=$pdo->query($sql);
$user=$stmt->fetch(PDO::FETCH_ASSOC);
if(!password_verify( $password,$user["password"])){
    header("Location:../changeinfo.php?err=6");
    exit();

}

 try {
  
    $sql= "UPDATE   users SET email=:email , name=:name WHERE id=:id ";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
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
