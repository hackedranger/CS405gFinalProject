<?php
/**
 * Created by PhpStorm.
 * User: nick9
 * Date: 4/19/2018
 * Time: 10:21 PM
 */
    $isbns= filter_var($_POST['ISBN'], FILTER_SANITIZE_STRING);
    $ratings = filter_var($_POST['rating'], FILTER_SANITIZE_STRING);
    $reviews = filter_var($_POST['review'], FILTER_SANITIZE_STRING);
    $userID = $_SESSION['userId'];
    $insertPrep = $conn->prepare("INSERT INTO bgho224.reviews (UID, ISBN, rating, review) VALUES (:uid, :isbn, :rating, :review)");
    $insertPrep->bindParam(":uid", $userID);
    $insertPrep->bindParam(":isbn", $isbns);
    $insertPrep->bindParam(":rating", $ratings);
    $insertPrep->bindParam(":review", $reviews);
    try{
        $insertPrep->execute();
    }
    catch(PDOException $insertPrepError){
        echo "ERROR: " . $insertPrepError->getMessage();
        exit();
    }