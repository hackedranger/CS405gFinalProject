<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 9:45 PM
 */
require_once("connect.php");
$ISBN = $_POST['ISBN'];
$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
$publisher = filter_var($_POST['publisher'], FILTER_SANITIZE_STRING);
$language = filter_var($_POST['language'], FILTER_SANITIZE_STRING);
$pubDate = filter_var($_POST['pubdate'], FILTER_SANITIZE_STRING);
$price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT);
$quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$summary = filter_var($_POST['summary'], FILTER_SANITIZE_STRING);
$author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
$updatePrep = $conn->prepare("UPDATE bgho224.books SET name = :name, publisher = :publisher, language = :language, pubDate = :pubDate, price = :price, QUANTITY = :quantity, subject = :subject, summary = :summary WHERE ISBN = :isbn");
$updatePrep->bindParam(":isbn", $ISBN);
$updatePrep->bindParam(":name", $title);
$updatePrep->bindParam(":publisher", $publisher);
$updatePrep->bindParam(":language", $language);
$updatePrep->bindParam(":pubDate", $pubDate);
$updatePrep->bindParam(":price", $price);
$updatePrep->bindParam(":quantity", $quantity);
$updatePrep->bindParam(":subject", $subject);
$updatePrep->bindParam(":summary", $summary);
$updatePrep2 = $conn->prepare("UPDATE bgho224.authors SET author = :author WHERE ISBN = :isbn");
$updatePrep2->bindParam(":isbn", $ISBN);
$updatePrep2->bindParam(":author", $author);
try{
    $updatePrep->execute();
    $updatePrep2->execute();
}
catch(PDOException $updatePrepError){
    echo "ERROR: " . $updatePrepError->getMessage();
    exit();
}