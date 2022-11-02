<?php

$db = new PDO("mysql::dbhost=localhost ; dbname=testing_project" , "root" , "" ,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING ,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ

]);
$email = $_POST['email'];
$pass = $_POST['password'];
$query = "INSERT INTO users (email , pass) VALUES (email=$email , password = $pass)";


$query1 = $db->query("SELECT * FROM users WHERE email=$email");

try {
      if($query1->fetch()) {
            echo "success";
      } else {
            echo 'Fail' ;
      }
} catch(PDOException $e) {
      echo $e->getMessage();
      exit();
}

// 'OR 1 = 1 ; --
// ': SQL : --