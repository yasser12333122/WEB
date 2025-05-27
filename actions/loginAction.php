<?php
session_start();
require "../connection.php"; 
require("../components/checkiflogin.php"); // 3ashen ne7me 7alna mn forms baraneye

if($_SERVER["REQUEST_METHOD"] !="POST"){
    die("WRONG METHOD");
}
$email=htmlspecialchars(trim($_POST["email"]));
$password=htmlspecialchars(trim($_POST["pass"]));

$_SESSION["email"]=$email;

if(!isset($email) || empty($email) ||
 !isset($password) || empty($password)){
    header("Location: ../login.php?err=1");
    exit();

 } 
 try{
    $sql="SELECT id,email,name,password FROM users WHERE email=:email";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user){
    header("Location: ../login.php?err=2");     // iza ma 3nde user tal3lo error
    exit();
  
}
if(!password_verify($password,$user["password"])){ //iza pass 8alat tal3lo error 
    header("Location: ../login.php?err=2");     
    exit();

}
$_SESSION["loggedIn"]=true;
$_SESSION["userid"]=$user["id"]; 
$_SESSION["name"]=$user["name"];
header("Location:/BLOG/index.php");
exit();


}
   

 catch (PDOException $ex){
        header("Location:../login.php?err=3");     
        exit();
 }
 
?>
