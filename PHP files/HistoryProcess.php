<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 9:44 PM
 */
require_once("connect.php");

$uid = $_SESSION['userId'];

$recordPrep= $conn->prepare("SELECT * FROM bgho224.orders WHERE UID = {$uid}");
try{
    $recordPrep->execute();
}
catch(PDOException $recordPrepError){
    echo "ERROR: " . $recordPrepError->getMessage();
    exit();
}
$records = $recordPrep->fetchAll();
foreach($records as $r){
    $orderNum = $r['orderNumber'];
    $ISBN = $r['ISBN'];
    $ccNumber = $r['ccNumber'];
    $cost = $r['cost'];
    $status = $r['status'];
    $quantity = $r['quantity'];
    $billingAddr= $r['billingAddr'];
    $orderDate = $r['orderDate'];
    $shippingAddr = $r['shippingAddr'];
}