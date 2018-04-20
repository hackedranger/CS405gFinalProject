<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 9:44 PM
 */
require_once("connect.php");

if(isset($_POST['ISBN'])){
    $isbn = $_POST['ISBN'];
    $recordPrep = $conn->prepare("SELECT * FROM bgho224.reviews WHERE ISBN = {$isbn}");
}
if(isset($_POST['UID'])){
    $uid = $_POST['UID'];
    $recordPrep = $conn->prepare("SELECT * FROM bgho224.reviews WHERE UID = {$uid}");
}
try{
    $recordPrep->execute();
}
catch (PDOException $recordPrepError){
    echo "ERROR: " . $recordPrepError->getMessage();
}
$records = $recordPrep->fetchAll();
foreach($records as $r){
    $rating = $r['rating'];
    $review = $r['review'];
}