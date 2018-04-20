<?php
/**
 * Created by PhpStorm.
 * User: ntea222
 * Date: 4/19/2018
 * Time: 2:42 PM
 */
require_once("connect.php");

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$role = $_POST['role'];
$firstName = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
$midName = filter_var($_POST['mname'], FILTER_SANITIZE_STRING);
$age = filter_var($_POST['age'], FILTER_SANITIZE_STRING);
$gender = $_POST['gender'];

$insertPrep= $conn->prepare("INSERT INTO bgho224.users (email, password, role, fname, mname, lname, age, gender) VALUES (:email, :password, :role, :fname, :mname, :lname, :age, :gender)");
$insertPrep->bindParam(":email",$email);
$insertPrep->bindParam(":password", $password);
$insertPrep->bindParam(":role", $role);
$insertPrep->bindParam(":fname", $firstName);
$insertPrep->bindParam(":mname", $midName);
$insertPrep->bindParam(":lname", $lastName);
$insertPrep->bindParam(":age", $age);
$insertPrep->bindParam(":gender", $gender);
try{
    $insertPrep->execute();
}
catch (PDOEXception $insertPrepError){
    echo "ERROR: " . $insertPrepError->getMessage();
    exit();
}
