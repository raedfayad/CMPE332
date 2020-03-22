<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "Animals";

// Create connection
try{
   $pdo = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
   die('Unable to connect with the database');
}
 ?>
