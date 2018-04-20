<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 9:45 PM
 */
require_once("connect.php");
$ISBN = $_POST['ISBN'];
$keyword = filter_var($_POST['keyword'], FILTER_SANITIZE_STRING);
$updatePrep = $conn->prepare("UPDATE bgho224.book_keywords SET KEYWORD = :keyword WHERE ISBN = :isbn");
$updatePrep->bindParam(":isbn", $ISBN);
$updatePrep->bindParam(":keyword", $keyword);
try{
    $updatePrep->execute();
}
catch(PDOException $updatePrepError){
    echo "ERROR: " . $updatePrepError->getMessage();
    exit();
}