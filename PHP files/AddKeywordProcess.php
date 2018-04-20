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
$insertPrep = $conn->prepare("INSERT INTO bgho224.book_keywords (ISBN, KEYWORD) VALUES (:isbn, :keyword)");
$insertPrep->bindParam(":isbn", $ISBN);
$insertPrep->bindParam(":keyword", $keyword);
try{
    $insertPrep->execute();
}
catch(PDOException $insertPrepError){
    echo "ERROR: " . $insertPrepError->getMessage();
    exit();
}