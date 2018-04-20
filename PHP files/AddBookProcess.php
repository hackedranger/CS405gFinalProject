<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 9:45 PM
 */
require_once("connect.php");
$ISBN = filter_var($_POST['ISBN'], FILTER_SANITIZE_STRING);
$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
$publisher = filter_var($_POST['publisher'], FILTER_SANITIZE_STRING);
$language = filter_var($_POST['language'], FILTER_SANITIZE_STRING);
$pubDate = filter_var($_POST['pubdate'], FILTER_SANITIZE_STRING);
$price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT);
$quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$summary = filter_var($_POST['summary'], FILTER_SANITIZE_STRING);
$author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
$insertPrep = $conn->prepare("INSERT INTO bgho224.books (ISBN, name, publisher, language, pubDate, price, QUANTITY, subject, summary) VALUES (:isbn, :name, :publisher, :language, :pubDate, :price, :quantity, :subject, :summary)");
$insertPrep->bindParam(":isbn", $ISBN);
$insertPrep->bindParam(":name", $title);
$insertPrep->bindParam(":publisher", $publisher);
$insertPrep->bindParam(":language", $language);
$insertPrep->bindParam(":pubDate", $pubDate);
$insertPrep->bindParam(":price", $price);
$insertPrep->bindParam(":quantity", $quantity);
$insertPrep->bindParam(":subject", $subject);
$insertPrep->bindParam(":summary", $summary);
$insertPrep2 = $conn->prepare("INSERT INTO bgho224.authors (ISBN, author) VALUES (:isbn, :author)");
$insertPrep2->bindParam(":isbn", $ISBN);
$insertPrep2->bindParam(":author", $author);
try{
    $insertPrep->execute();
    $insertPrep2->execute();
}
catch(PDOException $insertPrepError){
    echo "ERROR: " . $insertPrepError->getMessage();
    exit();
}