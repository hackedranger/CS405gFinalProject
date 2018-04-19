<?php
//PHP goes here
try{
    $dsn = "mysql:host=mysql.cs.uky.edu; dbname=bgho224; charset=utf8;";
    $conn = new PDO($dsn,'bgho224','team16');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $error){
    echo 'Connection failed: ' . $error->getMessage();
    exit;
}
?>