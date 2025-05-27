<?php
$server = "dbb.mysql.database.azure.com";
$username = "admin2";
$password = "admin123##";
$db = "blog";
try {
    $pdo = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $exc){
    die("Connection to database failed! Error: " . $exc->getMessage());
}
