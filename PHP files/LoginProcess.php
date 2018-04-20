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
$recordPrep=$conn->prepare("SELECT * FROM bgho224.users");
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
    if($email == $loginEmail && $password == $loginPassword){
        header("Location: storefront.html");
        if($role == 'Manager'){
            $_SESSION['username']=$email;
            $_SESSION['role']=$role;
        }
    }
    else{
        echo "Invalid Login";
        header("Location: index.html");
    }
}
