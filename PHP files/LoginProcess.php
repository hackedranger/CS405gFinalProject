<?php
/**
 * Created by PhpStorm.
 * User: ntea222
 * Date: 4/19/2018
 * Time: 2:42 PM
 */
require_once("connect.php");
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
if(isset($_POST['password'])){
    $password= $_POST['password'];
}
$recordPrep=$conn->prepare("SELECT * FROM book_db.users");
try{
    $recordPrep->execute();
}
catch(PDOException $recordError){
    echo "ERROR: " . $recordError->getMessage();
    exit();
}
$record=$recordPrep->fetchAll();
foreach($record as $r){
    $loginEmail = $r['email'];
    $loginPassword = $r['password'];
    $role = $r['role'];
    $userID = $r['UID'];
    if($email == $loginEmail && $password == $loginPassword){
        $_SESSION['role']=$role;
        $_SESSION['userId']=$userID;
    }
    else{
        echo "Invalid Login";
        header("Location: index.html");
    }
}