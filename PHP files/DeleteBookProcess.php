<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 9:45 PM
 */
require_once("connect.php");
$isbn = $_POST['ISBN'];
$recordPrep = $conn->prepare("DELETE * FROM bgho224.books, bgho224.book_keywords, bgho224.authors WHERE ISBN = {$isbn}");
try{
    $recordPrep->execute();
}
catch(PDOException $recordPrepError){
    echo "ERROR: " . $recordPrepError->getMessage();
    exit();
}