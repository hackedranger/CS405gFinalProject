<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 9:44 PM
 */
require_once("connect.php");
$uid = $_SESSION['userId'];
$ISBN = $_POST['ISBN'];
$ccNumber = $_POST['ccNumber'];
$cost = $_POST['price'];
$status = 'Pending';
$quantity = $_POST['quantity'];
$billingAddr = filter_var($_POST['billingAddr'], FILTER_SANITIZE_STRING);
$shippingAddr = filter_var($_POST['shippingAddr'], FILTER_SANITIZE_STRING);
$insertPrep = $conn->prepare("INSERT INTO bgho224.orders (UID, ISBN, ccNumber, cost, status, quantity, billingAddr, orderDate, shippingAddr) VALUES (:uid, :isbn, :ccnumber, :cost, :status, :quantity, :billingAddr, now(), :shippingAddr)");
$insertPrep->bindParam(":uid", $uid);
$insertPrep->bindParam(":isbn", $ISBN);
$insertPrep->bindParam(":ccnumber", $ccNumber);
$insertPrep->bindParam(":cost", $cost);
$insertPrep->bindParam(":status", $status);
$insertPrep->bindParam(":quantity", $quantity);
$insertPrep->bindParam(":billingAddr", $billingAddr);
$insertPrep->bindParam(":shippingAddr", $shippingAddr);
try{
    $insertPrep->execute();
}
catch(PDOException $insertPrepError){
    echo "ERROR: " . $insertPrepError->getMessage();
    exit();
}
