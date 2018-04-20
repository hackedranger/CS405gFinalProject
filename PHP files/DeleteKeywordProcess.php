<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 9:46 PM
 */
require_once("connect.php");
$keyword = $_POST['keyword'];
$isbn = $_POST['ISBN'];
$recordPrep = $conn->prepare("DELETE * FROM bgho224.book_keywords WHERE ISBN = {$isbn} AND KEYWORD = {$keyword}");
try{
    $recordPrep->execute();
}
catch(PDOException $recordPrepError){
    echo "ERROR: " . $recordPrepError->getMessage();
    exit();
}